function update_list() {
    let search = document.getElementById('search').value;
    let table = document.getElementById('post-table');

    for (let i = table.rows.length - 2; i > 1; i--) {
        table.deleteRow(i);
    }

    let xhttp = new XMLHttpRequest();
    xhttp.open('POST', '../controller/getSearchResult.php', true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send('get_searched_posts=true&search=' + search);

    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            let result = JSON.parse(this.responseText);
            if (result.length > 0) {
                result.forEach(element => {

                    const newRow = table.insertRow(table.rows.length - 1);
                    newRow.innerHTML = getNewRow(element);

                });
            }
            else {
                const newRow = table.insertRow(table.rows.length - 1);
                newRow.innerHTML = "<td align='center' colspan='5'><h2>No result found</h2></td>";
                newRow.style.color = "red";
            }

        }


    }
}

function getNewRow(element) {
    let newrow = '' +
        '<tr>' +
        '<td>' + element.post_id + '</td>' +
        '<td><a href="profile_view.php?username=' + element.author + '">@' + element.author + '</a></td>' +
        '<td>' + getFormatedDate(element.date) + '</td>' +
        '<td>' +
        '<a href="view_single_post.php?post_id=' + element.post_id + '"><input type="button" value="View"></a>' +

        '&nbsp;<input type="submit" name="remove_post" value="Remove">' +

        '<input type="hidden" name="post_id" value="' + element.post_id + '">' +
        '</td>' +
        '</tr>';
    return newrow;
}

function getFormatedDate(dateString) {
    const dateObject = new Date(dateString);

    const year = dateObject.getFullYear();
    const month = String(dateObject.getMonth() + 1).padStart(2, "0");
    const day = String(dateObject.getDate()).padStart(2, "0");

    const formattedDate = `${year}-${month}-${day}`;

    return formattedDate;

}

