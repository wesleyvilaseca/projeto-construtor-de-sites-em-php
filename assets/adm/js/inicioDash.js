var rel1 = new Chart(document.getElementById('rel1'), {
    type: 'line',
    data: {
        labels: ['10/10', '11/10', '12/10', '13/10'],
        datasets: [{
            label: 'Receita',
            data: [5, 6, 9, 3],
            fill: false,
            backgroundColor: '#0000FF',
            borderColor: '#0000FF'
        }]
    },

    options: {
        responsive: true,
        maintainAspectRatio: false
    }

});

var rel2 = new Chart(document.getElementById('rel2'), {
    type: 'pie',
    data: {
        labels: ['Pendente', 'Em andamento', 'Saiu para entrega', 'entrege'],
        datasets: [{
            data: [5, 7, 5, 10],
            backgroundColor: ['#dc3545', '#f7b924', '#007bff', '#28a745']
        }],
    },
    options: {
        responsive: true,
        maintainAspectRatio: false
    }
});



