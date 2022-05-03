
<div class="chart-data">
                    <?php
                    $this_month = date('m');
                    // echo $this_month;
                    $query_data = "SELECT orders_detail.quantity AS orders_detail_Quantity, DAY(time_accept) AS each_day 
                    FROM orders INNER JOIN orders_detail ON orders_detail.orders_id = orders.id
                    WHERE orders_detail.product_id = '$id' AND MONTH(time_accept) = '$this_month'";
                    $connect = connect();
                    $result_data = mysqli_query($connect, $query_data);
                    $arr = [];
                    $current_total_day = date("t");
                    for($i = 1; $i <= $current_total_day; $i++){
                        $arr[$i] = 0;
                    }
                    $max_product = 0;
                    foreach ($result_data as $each) {
                        $arr[$each['each_day']] = $each['orders_detail_Quantity'];
                        if($each['orders_detail_Quantity'] > $max_product){
                            $max_product = $each['orders_detail_Quantity'];
                        }
                    }
                    $max_product_data = (int)($max_product);
                
                    $arr_data = array_values($arr);

                    ?>
                </div>
                <div class="chart-detail-product-content" id="chart-detail-product-content">
                    <canvas id="myChart" style="height:100%;max-height:400px;"></canvas>
                </div>
            </div>
        </div>

    </div>
</body>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js"> </script>

<script>
    const get_day_of_month = (year, month) => {
        return new Date(year, month, 0).getDate();
    };
</script>
<script>
    const d = new Date();
    const month = d.getMonth() + 1;
    const year = d.getFullYear();
    let get_day_of_month_now = get_day_of_month(year, month);
    console.log(get_day_of_month_now);
    const data_date_of_month_all = [];
    for (let i = 1; i < 32; i++) {
        data_date_of_month_all[i - 1] = i;
    }
    switch (get_day_of_month_now) {
        case 31:

            break;
        case 30:
            const removed = data_date_of_month_all.splice(30, 1)
            break;
        case 28:
            const removed1 = data_date_of_month_all.splice(28, 3)

            break;
        case 29:
            const removed2 = data_date_of_month_all.splice(29, 2)
            break;

    }


    const data = {
        labels: data_date_of_month_all,
        datasets: [{
            label: 'Số sản phẩm bán được',
            backgroundColor: 'rgb(255, 99, 132)',
            borderColor: 'rgb(255, 99, 132)',
            data: <?php echo json_encode($arr_data) ?>,
        }]
    };

    const config = {
        type: 'line',
        data: data,
        options: {
            animation: {
                delay: 1500, // change delay to suit your needs.
            },
            animations: {
                tension: {
                    duration: 1000,
                    easing: 'linear',
                    from: 1,
                    to: 0,
                }
            },
            scales: {
                y: {
                    min: 0,
                    max: <?php echo $max_product_data + 1 ?>
                }
            }
        }
    };
</script>
<script>
    const myChart = new Chart(
        document.getElementById('myChart'),
        config
    );
</script>