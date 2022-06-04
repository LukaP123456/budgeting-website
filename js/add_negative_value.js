$(document).ready(function () {
    $("#delete_btn").click(function (){
        $('#neg_amount').removeClass("border border-danger border-2").removeClass("border border-success border-2");
        $('#neg_category').removeClass("border border-danger border-2").removeClass("border border-success border-2");
        $('#neg_date').removeClass("border border-danger border-2").removeClass("border border-success border-2");

        $("#error_neg_amount").html("").removeClass("text-danger fas fa-exclamation-circle ");
        $("#error_neg_category").val("").removeClass("text-danger fas fa-exclamation-circle ");
        $("#error_neg_date").html("").removeClass("text-danger fas fa-exclamation-circle ");

        $("#neg_response").html("");


    });



    //use button click event
    $("#neg_submit").click(function (e) {
        e.preventDefault();
        let amount = $("#neg_amount").val().trim();
        let neg_category = $("#neg_category").val();
        let neg_date = $("#neg_date").val();
        let cost_description = $("#cost_description").val().trim();

        let check_neg_amount = 0;
        let check_neg_category = 0;
        let check_neg_date = 0;
        let check_cost_description = 0;

        if (amount === ""){
            $("#neg_amount").addClass("border border-danger border-2");
            $("#error_neg_amount").html("<small> Please add an amount </small>").addClass("text-danger fas fa-exclamation-circle ");
            check_neg_amount = 1;
        }else {
            $('#neg_amount').addClass("border border-success border-2").removeClass("border border-danger border-2");
            $("#error_neg_amount").text("Looks good!").removeClass("text-danger fas fa-exclamation-circle ").addClass("text-success fas fas fa-check-circle");
        }

        if (cost_description === ""){
            $("#cost_description").addClass("border border-danger border-2");
            $("#error_cost_description").html("<small> Please describe your cost </small>").addClass("text-danger fas fa-exclamation-circle ");
            check_cost_description = 1;
        }else {
            $('#cost_description').addClass("border border-success border-2").removeClass("border border-danger border-2");
            $("#error_cost_description").text("Looks good!").removeClass("text-danger fas fa-exclamation-circle ").addClass("text-success fas fas fa-check-circle");
        }

        if (neg_category=== "category"){
            $("#neg_category").addClass("border border-danger border-2");
            $("#error_neg_category").html("<small> Please select a value </small>").addClass("text-danger fas fa-exclamation-circle ");
            check_neg_category = 1;
        }else{
            $('#neg_category').addClass("border border-success border-2").removeClass("border border-danger border-2");
            $("#error_neg_category").text("Looks good!").removeClass("text-danger fas fa-exclamation-circle ").addClass("text-success fas fas fa-check-circle");
        }

        if (neg_date === ""){
            $("#neg_date").addClass("border border-danger border-2");
            $("#error_neg_date").html("<small> Please choose a date </small>").addClass("text-danger fas fa-exclamation-circle ");
            check_neg_date = 1;
        }else{
            $('#neg_date').addClass("border border-success border-2").removeClass("border border-danger border-2");
            $("#error_neg_date").text("Looks good!").removeClass("text-danger fas fa-exclamation-circle ").addClass("text-success fas fas fa-check-circle");
        }

        if (check_neg_amount !==1 && check_neg_category !==1  && check_neg_date !==1 && check_cost_description !==1  ){
            $.ajax({
                method: "post",
                url: "add-negative-value.php",
                data: {
                    amount: amount,
                    neg_category: neg_category,
                    neg_date: neg_date,
                    cost_description : cost_description
                },
                success: function (response) {
                    console.log(response);
                    if (response === "success") {
                        $("#neg_response").html("<div class='alert alert-success' role='alert'>Successfully added a new cost of $" + amount + "</div>");

                        $.ajax({
                            type: "POST",
                            url: "get_expenses.php",
                            success: function (response) {
                                $("#delete").on("hidden.bs.modal", function (e) {
                                    $("#full_expenses").html("<p>$-" + response + "</p>");

                                    budget_expenses_chart.data.datasets[0].data[1] = response;
                                    budget_expenses_chart.update('active');

                                    $("#neg_amount").val(" ");
                                    $("#neg_category").val(" ");
                                    $("#neg_date").val(" ");
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
        }

    });
});