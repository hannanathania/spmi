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

fetch('/api_pt')
    .then(response => response.json())
    .then(data => {
        let unggul = 0;
        let baik = 0;
        let baik_sekali = 0;
        let b =0;
        let a =0;
        let tidak_tersedia = 0; 
        
        data.forEach(item => {
            if (item.akreditasi === 'Unggul') {
                unggul++;
            } else if (item.akreditasi === 'Baik') {
                baik++;
            } else if (item.akreditasi === 'Baik Sekali') {
                baik_sekali++;
            } else if (item.akreditasi === 'Tidak tersedia') {
                tidak_tersedia++;
            } else if (item.akreditasi === 'A') {
                a++;
            } else if (item.akreditasi === 'B') {
                b++;
            }
          });

        const config = {
            type: 'pie', // Pie chart type
            data: {
                labels: ['Unggul', 'A', 'Baik Sekali', 'Baik', 'B', 'Tidak Tersedia'], // Labels for the chart
                datasets: [{
                    data: [unggul, a, baik_sekali, baik, b, tidak_tersedia], // Data from the server
                    backgroundColor: [
                        '#4e73df', 
                        '#1cc88a', 
                        '#36b9cc', 
                        '#6a89cc', 
                        '#17a673', 
                        '#2c9faf'
                    ],
                    hoverBackgroundColor: [
                        '#2c4a7a', // lebih gelap dari '#375a9e'
                        '#0d5b40', // lebih gelap dari '#13855c'
                        '#1b6067', // lebih gelap dari '#258795'
                        '#30485f', // lebih gelap dari '#5079a5'
                        '#08412f', // lebih gelap dari '#0f624d'
                        '#144c59'  // lebih gelap dari '#1d7684'
                    ]
                    
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

fetch('/data/klinik_spmi')
    .then(response => {
        console.log('Fetching data...');
        if (!response.ok) {
            throw new Error(`HTTP error! status: ${response.status}`);
        }
        return response.json();
    })
    .then(data => {
        console.log('Data fetched:', data);
        let adaCount = 0;
        let tidakAdaCount = 0;

        if (Array.isArray(data.data_klinik)) {
            data.data_klinik.forEach(item => {
                if (item.progress === 'Ada') {
                    adaCount++;
                } else if (item.progress === 'Tidak Ada') {
                    tidakAdaCount++;
                }
            });
        } else {
            throw new Error('Data format is incorrect');
        }

        console.log('Count Ada:', adaCount);
        console.log('Count Tidak Ada:', tidakAdaCount);

        const ctx = document.getElementById('myPieChart6');
        if (ctx) {
            console.log('Canvas found:', ctx);
            const config = {
                type: 'pie',
                data: {
                    labels: ['Ada', 'Tidak Ada'],
                    datasets: [{
                        data: [adaCount, tidakAdaCount],
                        backgroundColor: ['#4e73df', '#1cc88a'], // Warna SB Admin 2
                        hoverBackgroundColor: ['#3753d8', '#17a673'], // Warna hover
                    }]
                },
                options: {
                    maintainAspectRatio: false,
                    plugins: {
                        tooltip: {
                            backgroundColor: "rgb(255,255,255)",
                            bodyColor: "#858796",
                            borderColor: '#dddfeb',
                            borderWidth: 1,
                            padding: 10,
                            displayColors: true,
                            caretPadding: 10
                        },
                        legend: {
                            display: true,
                            position: 'top',
                            align: 'start'
                        }
                    }
                }
            };

            new Chart(ctx, config);
            console.log('Chart created successfully!');
        } else {
            console.error('Canvas element with id "myPieChart6" not found.');
        }
    })
    .catch(error => console.error('Error fetching or processing data:', error));



  
