$(document).ready(function () {
    $("#add_btn").click(function (){
        $('#pos_amount').removeClass("border border-danger border-2").removeClass("border border-success border-2");
        $('#pos_category').removeClass("border border-danger border-2").removeClass("border border-success border-2");
        $('#pos_date').removeClass("border border-danger border-2").removeClass("border border-success border-2");

        $("#error_pos_amount").html("").removeClass("text-danger fas fa-exclamation-circle ");
        $("#error_pos_category").html("").removeClass("text-danger fas fa-exclamation-circle ");
        $("#error_pos_date").html("").removeClass("text-danger fas fa-exclamation-circle ");

        $("#pos_response").html("");


    });

    //use button click event
    $("#pos_submit").click(function (e) {
        e.preventDefault();
        let pos_amount = $('#pos_amount').val().trim();
        let pos_category = $("#pos_category").val();
        let pos_date = $("#pos_date").val();

        let check_pos_amount = 0;
        let check_pos_category = 0;
        let check_pos_date = 0;


        if (pos_amount === ""){
            $("#pos_amount").addClass("border border-danger border-2");
            $("#error_pos_amount").html("<small> Please add an amount </small>").addClass("text-danger fas fa-exclamation-circle ");
            check_pos_amount = 1;
        }else {
            $('#pos_amount').addClass("border border-success border-2").removeClass("border border-danger border-2");
            $("#error_pos_amount").text("Looks good!").removeClass("text-danger fas fa-exclamation-circle ").addClass("text-success fas fas fa-check-circle");
        }

        if (pos_category=== "category"){
            $("#pos_category").addClass("border border-danger border-2");
            $("#error_pos_category").html("<small> Please select a value </small>").addClass("text-danger fas fa-exclamation-circle ");
            check_pos_category = 1;
        }else{
            $('#pos_category').addClass("border border-success border-2").removeClass("border border-danger border-2");
            $("#error_pos_category").text("Looks good!").removeClass("text-danger fas fa-exclamation-circle ").addClass("text-success fas fas fa-check-circle");
        }

        if (pos_date === ""){
            $("#pos_date").addClass("border border-danger border-2");
            $("#error_pos_date").html("<small> Please choose a date </small>").addClass("text-danger fas fa-exclamation-circle ");
            check_pos_date = 1;
        }else{
            $('#pos_date').addClass("border border-success border-2").removeClass("border border-danger border-2");
            $("#error_pos_date").text("Looks good!").removeClass("text-danger fas fa-exclamation-circle ").addClass("text-success fas fas fa-check-circle");
        }


        if (check_pos_amount !==1 && check_pos_category !==1  && check_pos_date !==1 ){
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
                    swal("Good job!",  "Successfully added an amount of: $"+pos_amount+" to your income in category: "+pos_category+" date added: "+pos_date, "success");

                    if (response === "success") {
                        $("#pos_response").html("<div class='alert alert-success' role='alert'>Successfully added an amount of $" + pos_amount + "</div>");

                        $.ajax({
                            type: "POST",
                            url: "get_budget.php",
                            success: function (response) {
                                $("#enroll").on("hidden.bs.modal",function () {
                                    $("#full_budget").html("<p>$" + response + "</p>");

                                    budget_expenses_chart.data.datasets[0].data[0] = response;
                                    budget_expenses_chart.update('active');

                                    $("#pos_date").val("");
                                    $("#pos_category").val("choose");
                                    $("#pos_amount").val("");
                                });
                            },error:function (response){
                                alert(JSON.stringify(response));
                                swal("Warning",  response, "error");
                            }
                        })
                    }else {
                        $("#pos_response").html(response);
                        swal("Warning",  response, "error");

                        $("#pos_amount").addClass("border border-danger border-2");
                        $("#pos_category").addClass("border border-danger border-2");
                        $("#pos_date").addClass("border border-danger border-2");

                    }

                },
                error: function (response) {
                    alert(JSON.stringify(response));
                    swal("Warning",  response, "error");
                }
            })
        }


    })
});

