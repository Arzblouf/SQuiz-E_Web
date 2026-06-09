/*const ctx = document.getElementById('resultChart');

const results = [];

function processData(responses) {
    const counts = {};
    responses.forEach(r => {
        counts[r] = (counts[r] || 0) + 1;
    });
    return {
        labels: Object.keys(counts),
        values: Object.values(counts)
    };
}

function createChart(id, labels, data) {
    new Chart(document.getElementById(id), {
        type: 'pie',
        data: {
            labels: labels,
            datasets: [{
                data: data
            }]
        }
    });
}	

const rchart = processData(results);
createChart('resultChart', rchart.labels, rchart.values);*/