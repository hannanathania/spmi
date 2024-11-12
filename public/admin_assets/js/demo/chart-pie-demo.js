// Set default font family and color to match Bootstrap's styling
Chart.defaults.global.defaultFontFamily = 'Nunito, -apple-system, system-ui, BlinkMacSystemFont, "Segoe UI", Roboto, "Helvetica Neue", Arial, sans-serif';
Chart.defaults.global.defaultFontColor = '#858796';

// Ambil data dari server
fetch('/total_semua')
    .then(response => response.json())
    .then(data => {
        const config = {
            type: 'doughnut', // Tipe chart
            data: {
                labels: ['Belum Unggah', 'Sebagian Unggah', 'Semua Unggah'], // Menggunakan labels dari server
                datasets: [{
                    data: [data.belum_unggah, data.sebagian_unggah, data.semua_unggah], // Menggunakan data dari server
                    backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56'], // Warna untuk masing-masing bagian
                    hoverBackgroundColor: ['#FF6384', '#36A2EB', '#FFCE56']
                }]
            },
            options: {
                maintainAspectRatio: false,
                tooltips: {
                  backgroundColor: "rgb(255,255,255)",
                  bodyFontColor: "#858796",
                  borderColor: '#dddfeb',
                  borderWidth: 1,
                  xPadding: 15,
                  yPadding: 15,
                  displayColors: true,
                  caretPadding: 10,
                },
                legend: {
                  display: true
                },
                cutoutPercentage: 80,
                plugins: {
                  legend: {
                    position: 'top',
                    align: 'start',
                    padding: {
                      top: 10,
                      right: 0,
                      bottom: 0,
                      left: 0
                    },
                  }
                }
              }
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
                maintainAspectRatio: false,
                tooltips: {
                  backgroundColor: "rgb(255,255,255)",
                  bodyFontColor: "#858796",
                  borderColor: '#dddfeb',
                  borderWidth: 1,
                  xPadding: 15,
                  yPadding: 15,
                  displayColors: true,
                  caretPadding: 10,
                },
                legend: {
                  display: true
                },
                cutoutPercentage: 80,
                plugins: {
                  legend: {
                    position: 'top',
                    align: 'start',
                    padding: {
                      top: 10,
                      right: 0,
                      bottom: 0,
                      left: 0
                    },
                  }
                }
              }
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
                labels: ['Belum Tervalidasi', 'Sebagian Tervalidasi', 'Semua Tervalidasi'], // Menggunakan labels dari server
                datasets: [{
                    data: [data.belum_valid, data.sebagian_valid, data.semua_valid], // Menggunakan data dari server
                    backgroundColor: ['#FF6384', '#36A2EB', '#FFCE56'], // Warna untuk masing-masing bagian
                    hoverBackgroundColor: ['#FF6384', '#36A2EB', '#FFCE56']
                }]
            },
            options: {
                maintainAspectRatio: false,
                tooltips: {
                  backgroundColor: "rgb(255,255,255)",
                  bodyFontColor: "#858796",
                  borderColor: '#dddfeb',
                  borderWidth: 1,
                  xPadding: 15,
                  yPadding: 15,
                  displayColors: true,
                  caretPadding: 10,
                },
                legend: {
                  display: true
                },
                cutoutPercentage: 80,
                plugins: {
                  legend: {
                    position: 'top',
                    align: 'start',
                    padding: {
                      top: 10,
                      right: 0,
                      bottom: 0,
                      left: 0
                    },
                  }
                }
              }
        };

        // Buat instance chart
        const myPieChart = new Chart(
            document.getElementById('myPieChart3'),
            config
        );
    })
    .catch(error => console.error('Error fetching data:', error));