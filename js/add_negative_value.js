$(document).ready(function () {
    //use button click event
    $("#neg_submit").click(function (e) {
        e.preventDefault();
        let amount = $("#neg_amount").val();
        let neg_category = $("#neg_category").val();
        let neg_date = $("#neg_date").val();

        $.ajax({
            method: "post",
            url: "add-negative-value.php",
            data: {
                amount: amount,
                neg_category: neg_category,
                neg_date: neg_date
            },
            success: function (response) {
                console.log(response);
                if (response === "success") {
                    $("#neg_response").html("<div class='alert alert-success' role='alert'>Successfully added a new cost of $" + amount + "</div>");

                    $.ajax({
                        type: "GET",
                        url: "get_expenses.php",
                        success: function (response) {
                            $("#delete").on("hidden.bs.modal", function (e) {
                                $("#full_expenses").html("<p>$-" + response + "</p>");
                                const expenses = response;
                            });
                        }
                    })
                } else {
                    $("#neg_response").html(response);
                }
            },
            error: function (response) {
                alert(JSON.stringify(response));
            }
        })
    });
});