// Set default font family and color to match Bootstrap's styling
Chart.defaults.global.defaultFontFamily = 'Nunito, -apple-system, system-ui, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif';
Chart.defaults.global.defaultFontColor = '#858796';

// Ambil data dari server
fetch('/total_semua')
    .then(response => response.json())
    .then(data => {
        const config = {
            type: 'pie', // Tipe chart
            data: {
                labels: ['Tidak Unggah', 'Sebagian Unggah', 'Semua Unggah'], // Menggunakan labels dari server
                datasets: [{
                    data: [data.belum_unggah, data.sebagian_unggah, data.semua_unggah], // Menggunakan data dari server
                    backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56'], // Warna untuk masing-masing bagian
                    hoverBackgroundColor: ['#FF6384', '#36A2EB', '#FFCE56']
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: true,
                        text: 'Donut Chart Example' // Judul chart
                    }
                }
            },
        };

        // Buat instance chart
        const myPieChart = new Chart(
            document.getElementById('myPieChart'),
            config
        );
    })
    .catch(error => console.error('Error fetching data:', error));

// Ambil data dari server
fetch('/total_semua')
    .then(response => response.json())
    .then(data => {
        const config = {
            type: 'pie', // Tipe chart
            data: {
                labels: ['Belum Verifikasi', 'Sebagian Verifikasi', 'Semua Verifikasi'], // Menggunakan labels dari server
                datasets: [{
                    data: [data.belum_ver, data.sebagian_ver, data.semua_ver], // Menggunakan data dari server
                    backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56'], // Warna untuk masing-masing bagian
                    hoverBackgroundColor: ['#FF6384', '#36A2EB', '#FFCE56']
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: true,
                        text: 'Donut Chart Example' // Judul chart
                    }
                }
            },
        };

        // Buat instance chart
        const myPieChart = new Chart(
            document.getElementById('myPieChart2'),
            config
        );
    })
    .catch(error => console.error('Error fetching data:', error));

// Ambil data dari server
fetch('/total_semua')
    .then(response => response.json())
    .then(data => {
        const config = {
            type: 'pie', // Tipe chart
            data: {
                labels: ['Belum Valid', 'Sebagian Valid', 'Semua Valid'], // Menggunakan labels dari server
                datasets: [{
                    data: [data.belum_valid, data.sebagian_valid, data.semua_valid], // Menggunakan data dari server
                    backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56'], // Warna untuk masing-masing bagian
                    hoverBackgroundColor: ['#FF6384', '#36A2EB', '#FFCE56']
                }]
            },
            options: {
                responsive: true,
                plugins: {
                    legend: {
                        position: 'top',
                    },
                    title: {
                        display: true,
                        text: 'Donut Chart Example' // Judul chart
                    }
                }
            },
        };

        // Buat instance chart
        const myPieChart = new Chart(
            document.getElementById('myPieChart3'),
            config
        );
    })
    .catch(error => console.error('Error fetching data:', error));