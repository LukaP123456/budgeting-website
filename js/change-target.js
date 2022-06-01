$(document).ready(function () {
    $("#change_goal").click(function (){
        $('#amount').removeClass("border border-danger border-2").removeClass("border border-success border-2");
        $('#goal_name').removeClass("border border-danger border-2").removeClass("border border-success border-2");
    });

    //use button click event
    $("#goalBTN").click(function (e){
        e.preventDefault();

        let amount = $("#amount").val().trim();
        let goal = $("#goal_name").val().trim();

        let check_error_amount = 0;
        let check_error_goal = 0;

        if (amount === ""){
            //Amount field is empty so we add an error class
            $('#amount').addClass("border border-danger border-2");
            $("#error_amount").html("<small> Please add an amount </small>").addClass("text-danger fas fa-exclamation-circle ");
            check_error_amount = 1;
        }else {
            $('#amount').addClass("border border-success border-2").removeClass("border border-danger border-2");
            $("#error_amount").text(" ").removeClass("text-danger fas fa-exclamation-circle ");
        }

        if (goal === "" ){
            //Goal field is empty so we add an error class
            $('#goal_name').addClass("border border-danger border-2");
            $("#error_goal_name").html("<small> Please add an amount </small>").addClass("text-danger fas fa-exclamation-circle ");
            check_error_goal = 1;
        }else {
            $('#goal_name').addClass("border border-success border-2").removeClass("border border-danger border-2");
            $("#error_goal_name").text(" ").removeClass("text-danger fas fa-exclamation-circle ");
        }

        if (check_error_goal !==1 && check_error_amount !==1 ){
            //Client side error handling has returned a false value i.e there are no errors so we do the ajax call

            console.log(check_error_goal,check_error_amount)
            $.ajax({
                method: "post",
                url: "target-modal-code.php",
                data: {
                    amount: amount,
                    goal: goal
                },
                success: function (response){
                    console.log(response);
                    if(response === "success"){
                        $("#response").html("<p class='alert alert-success' role='alert'>Successfully changed target</p>");

                        $("#target").on("hidden.bs.modal",function (e){
                            $("#goal_response").html("<p>"+goal+"</p>");
                            $("#amount_response").html("<p>It's value is: $"+amount+"</p>");

                            $("#goal_name").val("").removeClass("border border-danger border-2").addClass("border border-success border-2");
                            $("#amount").val("").removeClass("border border-danger border-2").addClass("border border-success border-2");
                            $("#response").html("");

                        });
                    }else {
                        $("#response").html(response);

                        $("#goal_name").addClass("border border-danger border-2");
                        $("#amount").addClass("border border-danger border-2");
                    }
                },
                error: function(response) {
                    alert(JSON.stringify(response));
                }
            })
        }
    });
});
