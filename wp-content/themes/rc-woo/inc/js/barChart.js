
window.onload = function(){
    console.log("Loading barChart.js");
    console.log(Object.entries(themeParams[0]));
    new Chart(document.getElementById("bar-chart"),{
            type: 'bar',
            data: {
                datasets: [{
                    data: themeParams
                }]
            },
            options: {
                parsing: {
                    xAxisKey: 'Country',
                    yAxisKey: 'Population'
                }
            }
        }
    );
};