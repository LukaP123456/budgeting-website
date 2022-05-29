$(document).ready(function () {
    //use button click event
    $("#pos_submit").click(function (e) {
        e.preventDefault();
        let pos_amount = $("#pos_amount").val();
        let pos_category = $("#pos_category").val();
        let pos_date = $("#pos_date").val();

        $.ajax({
            method: "post",
            url: "add-positive-value.php",
            data: {
                pos_amount: pos_amount,
                pos_category: pos_category,
                pos_date: pos_date
            },
            success: function (response) {
                console.log(response);
                if (response === "success") {
                    $("#pos_response").html("<div class='alert alert-success' role='alert'>Successfully added an amount of $" + pos_amount + "</div>");

                    $.ajax({
                        type: "GET",
                        url: "get_budget.php",
                        success: function (response) {
                            $("#enroll").on("hidden.bs.modal",function () {
                                $("#full_budget").html("<p>$" + response + "</p>");

                                console.log(budget_expenses_chart.data.datasets[0].data[1]);
                                budget_expenses_chart.data.datasets[0].data[0] = response;
                                budget_expenses_chart.update('active');
                            });




                        }


                    })
                }else {
                    $("#pos_response").html(response);
                }

            },
            error: function (response) {
                alert(JSON.stringify(response));
            }
        })
    })
});

