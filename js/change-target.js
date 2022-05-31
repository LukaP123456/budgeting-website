$(document).ready(function () {
    //use button click event
    $("#goalBTN").click(function (e){
        e.preventDefault();
        let amount = $("#amount").val();
        let goal = $("#goal_name").val();

        $('#amount').removeClass("border border-danger").addClass("border border-success border-2");
        $('#goal_name').removeClass("border border-danger").addClass("border border-success border-2");

        let check_error;
        let check_error2;
        //TODO:Client side error ovde krecu
        if (amount === ""){
            //dodaj klasu error
            let check_error = 1;
        }

        if (goal === "" ){
            //dodaj klasu error
            let check_error2 = 1;
        }

        if (check_error2 !==1 && check_error !==1 ){
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

                            $("#goal_name").val(" ").removeClass("border border-danger border-2").removeClass("border border-success border-2");
                            $("#amount").val(" ").removeClass("border border-danger border-2").removeClass("border border-success border-2");
                            $("#response").html(" ");

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
