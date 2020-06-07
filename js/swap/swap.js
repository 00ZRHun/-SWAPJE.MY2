$(document).ready(function () {

    $('#swap-with-owner-btn').click(function (e) {        
        e.preventDefault();

        // Extract checkbox value
        const datas = [];

        $("input:checkbox[name=receiver_item_id]:checked").each(function() {            

            const data = {
                item_id: $("#item_id").val(),
                receiver_item_id: $(this).val(),
                receiver_id: $("#receiver_id").val(),
                provider_id: $("#provider_id").val()
            };        

            datas.push(data);
        });                          

        $.ajax({
            method: "POST",
            url: "functions/Swap/send_swap_request.php",
            dataType: "json",
            data: {
                datas
            },
            success: (data) => {
                if (data.code == "200")                       
                    alert("Send swap request: " + data.msg);
            },
            error: (err) => {
                console.log(err.msg)
                alert("Something went wrong. Please try again.");
            }
        });

    });


});

$('#accept-request-btn').click(function () {

    // Swap Request ID
    const swap_request_id = $(this).attr("data-requestID");    
        
    $.ajax({
        method: "POST",
        url: "functions/Swap/accept_request.php",
        dataType: "json",
        data: {
            swap_request_id
        },
        success: (data) => {
            if (data.code == "200") {                
                alert("You have accepted the request.");
                window.location = "swap_request.php";
            }                
        },
        error: (err) => {
            console.log(err.msg)
            alert("Something went wrong to accept the request. Please try again.");
        }
    })
});

$('#reject-request-btn').click(function () {

    // Swap Request ID
    const swap_request_id = $(this).attr("data-requestID");
        
    $.ajax({
        method: "POST",
        url: "functions/Swap/reject_request.php",
        dataType: "json",
        data: {
            swap_request_id
        },
        success: (data) => {
            if (data.code == "200") {
                alert("You have rejected the request.");
                window.location = "swap_request.php";
            }                
        },
        error: (err) => {
            console.log(err.msg)
            alert("Something went wrong to accept the request. Please try again.");
        }
    })

});