$(document).ready(function () {
    //use button click event
    $("#goalBTN").click(function (e){
        e.preventDefault();
        let amount = $("#amount").val();
        let goal = $("#goal_name").val();

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
                    $("#response").html("<div class='alert alert-success' role='alert'>Successfully changed target,refresh the page to see your goal</div>");

                    $("#load_btn").click(function (e){
                        $("#goal_response").html("<p>"+goal+"</p>");
                        $("#amount_response").html("<p>It's value is: $"+amount+"</p>");
                    });
                }
            },
            error: function(response) {
                alert(JSON.stringify(response));
            }
        })
    });
});
