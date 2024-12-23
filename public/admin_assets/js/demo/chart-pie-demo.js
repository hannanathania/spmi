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
                labels: ['Belum Unggah', 'Sebagian Unggah', 'Semua Unggah'], // Menggunakan labels dari server
                datasets: [{
                    data: [data.belum_unggah, data.sebagian_unggah, data.semua_unggah], // Menggunakan data dari server
                    backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc'], // Warna untuk masing-masing bagian
                    hoverBackgroundColor: ['#4e73df', '#1cc88a', '#36b9cc']
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
                  display: false
                },
                cutoutPercentage: 0,
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
                    backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc'], // Warna untuk masing-masing bagian
                    hoverBackgroundColor: ['#4e73df', '#1cc88a', '#36b9cc']
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
                  display: false
                },
                cutoutPercentage: 0,
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
                labels: ['Belum Valid', 'Sebagian Valid', 'Semua Valid'], // Menggunakan labels dari server
                datasets: [{
                    data: [data.belum_valid, data.sebagian_valid, data.semua_valid], // Menggunakan data dari server
                    backgroundColor: ['#4e73df', '#1cc88a', '#36b9cc'], // Warna untuk masing-masing bagian
                    hoverBackgroundColor: ['#4e73df', '#1cc88a', '#36b9cc']
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
                  display: false
                },
                cutoutPercentage: 0,
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

// Ambil data dari server
fetch('/total_semua')
    .then(response => response.json())
    .then(data => {
        const config = {
            type: 'pie', // Tipe chart
            data: {
                labels: ['Klaster Merah', 'Klaster Kuning', 'Klaster Hijau'], // Menggunakan labels dari server
                datasets: [{
                    data: [data.klaster_merah, data.klaster_kuning, data.klaster_hijau], // Menggunakan data dari server
                    backgroundColor: ['#ff0000', '#ffcc00', '#28a745'], // Red, Yellow, Green
                    hoverBackgroundColor: ['#ff0000', '#ffcc00', '#28a745'] // Red, Yellow, Green
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
                  display: false
                },
                cutoutPercentage: 0,
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
            document.getElementById('myPieChart4'),
            config
        );
    })
    .catch(error => console.error('Error fetching data:', error));

fetch('/data/klinik_spmi')
    .then(response => response.json())
    .then(data => {
        let adaCount = 0;
        let tidakAdaCount = 0;
        
        // Loop through each entry in the fetched `data.data_klinik` array
        data.data_klinik.forEach(item => {
            if (item.progress === 'Ada') {
                adaCount++;
            } else if (item.progress === 'Tidak Ada') {
                tidakAdaCount++;
            }
        });

        const config = {
            type: 'pie', // Pie chart type
            data: {
                labels: ['Ada', 'Tidak Ada'], // Labels for the chart
                datasets: [{
                    data: [adaCount, tidakAdaCount], // Data from the server
                    backgroundColor: ['#ff0000', '#ffcc00'], // Red for Ada, Yellow for Tidak Ada
                    hoverBackgroundColor: ['#ff0000', '#ffcc00'] // Hover colors
                }]
            },
            options: {
                maintainAspectRatio: false, // Ensure it maintains aspect ratio
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
                    display: false
                },
                cutoutPercentage: 0,
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

        // Create the pie chart instance
        const myPieChart = new Chart(
            document.getElementById('myPieChart5'),
            config
        );
    })
    .catch(error => console.error('Error fetching data:', error));
