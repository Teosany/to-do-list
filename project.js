$('.task').on("blur", function () {
        $.ajax({
            type: 'POST',
            url: 'post.php',
            data: {id: this.id, product: this.innerText}
        }).done(function (msg) {
            console.log(msg)
        })
    });


// it the same but with methode fetch
// $(function () {
//     $('.task').on("blur", function () {
//
//         let data = {    id: this.id, product: this.innerText    }
//
//         fetch('post.php', {
//             method: 'POST',
//             headers: {
//                 'Content-Type': 'application/json;charset=utf-8'
//             },
//             body: JSON.stringify(data)
//         })
//         console.log("Task #" + this.id + ' has been updated with new content: "' + this.innerText + '"');
//     });
// });


// it the same but with methode XMLHttpRequest
// $(function () {
//     $('.task').on("blur", function () {
//
//         let meta = 'id=' + this.id + '&product=' + this.innerText;
//
//         let request = new XMLHttpRequest();
//         request.open("POST", 'post.php');
//         request.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
//         request.responseType = "text";
//         request.onload = function () {
//             console.log("Done " + request.response)
//         }
//         request.send(meta);
//
//         console.log("Task #" + this.id + ' has been updated with new content: "' + this.innerText + '"');
//     });
// });
