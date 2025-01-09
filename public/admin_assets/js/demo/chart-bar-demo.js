// Set new default font family and font color to mimic Bootstrap's default styling
Chart.defaults.font.family = 'Nunito', '-apple-system', 'system-ui', 'BlinkMacSystemFont', '"Segoe UI"', 'Roboto', '"Helvetica Neue"', 'Arial', 'sans-serif';
Chart.defaults.font.color = '#858796';

function number_format(number, decimals, dec_point, thousands_sep) {
  // *     example: number_format(1234.56, 2, ',', ' ');
  // *     return: '1 234,56'
  number = (number + '').replace(',', '').replace(' ', '');
  var n = !isFinite(+number) ? 0 : +number,
    prec = !isFinite(+decimals) ? 0 : Math.abs(decimals),
    sep = (typeof thousands_sep === 'undefined') ? ',' : thousands_sep,
    dec = (typeof dec_point === 'undefined') ? '.' : dec_point,
    s = '',
    toFixedFix = function(n, prec) {
      var k = Math.pow(10, prec);
      return '' + Math.round(n * k) / k;
    };
  // Fix for IE parseFloat(0.55).toFixed(0) = 0;
  s = (prec ? toFixedFix(n, prec) : '' + Math.round(n)).split('.');
  if (s[0].length > 3) {
    s[0] = s[0].replace(/\B(?=(?:\d{3})+(?!\d))/g, sep);
  }
  if ((s[1] || '').length < prec) {
    s[1] = s[1] || '';
    s[1] += new Array(prec - s[1].length + 1).join('0');
  }
  return s.join(dec);
}

// Bar Chart Example
fetch('/data/fasilitator_wilayah') // Fetch from the correct endpoint
    .then(response => response.json())
    .then(data => {
        // Extract faswil names and PT counts
        const labels = Object.values(data).map(faswil => faswil.nama_faswil); // Extract faswil names
        const ptCounts = Object.values(data).map(faswil => faswil.pt.length); // Count PTs for each faswil
        
        console.log('Faswil Names (labels):', labels);
        console.log('PT Counts (ptCounts):', ptCounts);

        const config = {
          type: 'bar', // Bar chart type
          data: {
              labels: labels, // Use faswil names as labels
              datasets: [{
                  label: 'Jumlah PT', // Add label for the dataset
                  data: ptCounts, // Use PT counts as data
                  backgroundColor: ['#4e73df'], // Colors for each bar
                  hoverBackgroundColor: ['#4e73df']
              }]
          },
          options: {
              maintainAspectRatio: false, // Allow chart to scale independently
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
                  display: false,
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
      };
      

        // Create the bar chart
        const myBarChart = new Chart(
            document.getElementById('myBarChart'),
            config
        );
    })
    .catch(error => console.error('Error fetching data:', error));

document.addEventListener("DOMContentLoaded", function() {
        fetch('/api_pt') // Ambil data dari endpoint yang sesuai
            .then(response => response.json())
            .then(data => {
                const bentukCounts = {};
                const bentukDetails = {}; // Menyimpan nama PT untuk setiap bentuk
    
                // Menghitung jumlah PT per bentuk dan menyimpan detail PT
                data.forEach(item => {
                    bentukCounts[item.bentuk] = (bentukCounts[item.bentuk] || 0) + 1;
                    if (!bentukDetails[item.bentuk]) {
                        bentukDetails[item.bentuk] = [];
                    }
                    bentukDetails[item.bentuk].push(item.nm_lemb);
                });
    
                const bentukLabels = Object.keys(bentukCounts);
                const bentukData = Object.values(bentukCounts);
    
                const config = {
                    type: 'bar',
                    data: {
                        labels: bentukLabels,
                        datasets: [{
                            label: 'Jumlah PT',
                            data: bentukData,
                            backgroundColor: ['#4e73df'],
                            hoverBackgroundColor: ['#375a9e']
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
                            display: false,
                        }
                    }
                };
    
                // Membuat chart dengan konfigurasi
                const ctx = document.getElementById('myBarChart2').getContext('2d');
                const myBarChart = new Chart(ctx, config);
            })
            .catch(error => console.error('Error fetching data:', error));
    });    

fetch('/data/sebaran_pts') // Adjust the endpoint as needed
  .then(response => response.json())
  .then(data => {
    // Urutkan data berdasarkan jumlah_institusi terbanyak, dan ambil 5 teratas
    const top5SebaranPt = data
      .sort((a, b) => b.jumlah_institusi - a.jumlah_institusi)
      .slice(0, 5);

    // Extract city names and institutions count for top 5
    const labels = top5SebaranPt.map(item => item.kota_kab);
    const jumlahInstitusi = top5SebaranPt.map(item => item.jumlah_institusi);
    
    // Bar chart configuration
    const ctx = document.getElementById('myBarChart3').getContext('2d');
    const myBarChart3 = new Chart(ctx, {
      type: 'bar',
      data: {
        labels: labels,
        datasets: [{
          label: 'Jumlah Institusi',
          data: jumlahInstitusi,
          backgroundColor: ['#4e73df'], // Colors for each bar
          hoverBackgroundColor: ['#4e73df'],
          borderWidth: 1
        }]
      },
      options: {
        maintainAspectRatio: false, // Allow chart to scale independently
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
            display: false,
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
    });
  })
  .catch(error => console.error('Error fetching data:', error));

  