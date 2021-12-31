let allData = null;
let arr = ['January', "February", "March", "April", "May", "June", "July", "August", "September", "October", "November", "December"];

const no_of_sales = document.querySelector('.no-sales');
const earnings = document.querySelector('.no-earnings');

let currYearIncome = 0;
let currYearSales = 0;

const ctx = document.getElementById('my-chart').getContext('2d');
Chart.defaults.font.color = 'white';

let myChart = new Chart(ctx, {
    type: 'bar',
    data: {
        labels: ['Jan', 'Feb', 'Mar', 'Apr', 'May', 'June', 'July', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'],
        datasets: [{
            label: 'Earnings',
            data: [0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0],
            backgroundColor: [
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)',
                'rgba(255, 99, 132, 1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
            ]
        }]
    },
    options: {
        responsive: true,
        scales: {
            x: {
                ticks: {
                    color: '#bbb'
                }
            },
            y: {
                ticks: {
                    color: '#000'
                }
            }
        }
    }
});

$(document).ready(function() {

    let seller_id = document.querySelector('.seller-id.notify').value;

    const yearInput = document.getElementById('year');

    $.ajax({
        url: "http://localhost/Project/FlyBuy/PageController/getSalesHistory/" + seller_id,
        method: "POST",
        success: function(data) {

            const currYear = yearInput.value;

            let dataObj = JSON.parse(data);
            console.log(dataObj);
            allData = dataObj;
            
            for (let i = 0; i < dataObj.length; i++) {
                let element = dataObj[i];
                
                if (element.yr == currYear){
                    currYearSales = element.year_order_count;
                    currYearIncome = element.year_income;

                    for (let i = 0; i < 12; i++){
                        myChart.data.datasets[i].data = element.salesByMonth[arr[i]].month_income;
                    }
                }

                // set the current values in the page
                no_of_sales.innerText = currYearSales;
                earnings.innerText = currYearIncome;

                break;
                
            }
        }
    });

    
});

// by the time this function is called, allData should be declared and IT WILL BE.
function yearChanged(event){
    
    let selected_year = event.target.value;
    console.log(selected_year);
    // console.log(myChart.data);

    for (let i = 0; i < allData.length; i++) {
        let element = allData[i];
        
        if (element.yr == selected_year){
            currYearSales = element.year_order_count;
            currYearIncome = element.year_income;

            for (let i = 0; i < 12; i++){
                myChart.data.datasets[i].data = element.salesByMonth[arr[i]].month_income;
            }
        }

        // set the current values in the page
        no_of_sales.innerText = currYearSales;
        earnings.innerText = currYearIncome;

        break;
        
    }

}


