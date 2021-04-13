function newDate(days) {
    return moment().add(days, 'd').startOf('day').toDate();
}

function newDateString(days) {
    return moment().add(days, 'd').startOf('day').format();
}

var count = 0;

function randomPastelColor() {
    return Color[count++];
}

Color = [
    "#3cb44b",
    "#ffe119",
    "#0082c8",
    "#911eb4",
    "#46f0f0",
    "#f58231",
    "#f032e6",
    "#d2f53c",
    "#fabebe",
    "#008080",
    "#a6a6f2",
    "#ff99ff",
    "#aa6e28",
    "#000099",
    "#ff3333",

    "#3cb44b",
    "#ffe119",
    "#0082c8",
    "#f58231",
    "#911eb4",
    "#46f0f0",
    "#f032e6",
    "#d2f53c",
    "#fabebe",
    "#008080",
    "#a6a6f2",
    "#ff99ff",
    "#aa6e28",
    "#000099",
    "#ff3333",    
]

var color = Chart.helpers.color;

function buildConfig(classement, color) {

    var config = {
        type: 'line',
        options: {  
        responsive: true,
        title: {
            display: true,
            text: 'Historique classement ' + classement,
            fontColor: color,
            fontSize: '15'            
        },
        legend: {
            display: true,
            labels: {
                fontColor: '#fff'
            }
        },
        scales: {
            xAxes: [{
                type: 'time',
                gridLines: {
                    color: "#FFF"
                },
                display: true,
                time: {
                    unit: 'day',
                    unitStepSize: 1,
                    displayFormats: {
                        'day': 'MMM DD'
                    }
                },
                scaleLabel: {
                    display: true,
                    labelString: 'Date',
                    fontColor: color,
                    fontSize: '15'
                },
                ticks: {
                    fontColor: '#fff',
                    stepValue: 1,
                    displayFormats: {
                        quarter: 'MMM YYYY'
                    },
                    major: {
                        fontStyle: 'bold',
                        fontColor: '#FF0000'
                    }
                }
            }],
            yAxes: [{
                gridLines: {
                    color: "#FFF"
                },
                display: true,
                scaleLabel: {
                    display: true,
                    labelString: 'Classement',
                    fontColor: color,
                    fontSize: '15'
                }
            }]
        }
    }
};
return config; 
}

function createXY(data)
{
    var dataset  = new Array();
    
    for (var i = 0; i < data.length; i++)
    {
        var set = {
            "x" :  moment(data[i].x),
            "y" : data[i].y
         }; 
        dataset.push(set);
    }
    return dataset;
}

window.onload = function() {
}

function reloadGraph(color, classement, maxValue, step) {
    count = 0;
    var idcurrent = document.getElementById('idCurrent').innerText;

    var config = buildConfig(classement, color);

    var result = true;
    $.ajax({
        async: false, // !important
        url: 'getDataStatistic.php',
        data: 'classement=' + classement + "&id=" + idcurrent,
        success: function( data ) {
            data = JSON.parse(data);
            var dataset  = new Array();

            for (var i = 0; i < data.length; i++)
            {
                var set = {
                    "label" : data[i].name,
                    "fill" : false,
                    "borderColor" : randomPastelColor(),
                    "hidden": data[i].hidden,
                    "data" : createXY(data[i].data)
                 }; 
                dataset.push(set);
            }

            var ctx = document.getElementById('canvas' + classement).getContext('2d');
            dataset = {
                "datasets" : dataset
            };
            config.data = dataset;
            config.options.scales.yAxes[0].ticks = {
                reverse: true,
                fontColor: '#fff',
                beginAtZero: true,
                stepSize: step,
                max: maxValue,
                min: 1
            };
            window.myLine = new Chart(ctx, config);
        }
    });
    return result;

};


