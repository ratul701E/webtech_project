function update_list() {
    let search = document.getElementById('search').value;
    let table = document.getElementById('user-table');

    for (let i = table.rows.length - 2; i > 1; i--) {
        table.deleteRow(i);
    }

    let xhttp = new XMLHttpRequest();
    xhttp.open('POST', '../controller/getSearchResult.php', true);
    xhttp.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
    xhttp.send('get_searched_users=true&search=' + search);

    xhttp.onreadystatechange = function () {
        if (this.readyState == 4 && this.status == 200) {
            let result = JSON.parse(this.responseText);
            if(result.length > 0){
                result.forEach(element => {

                    const newRow = table.insertRow(table.rows.length - 1);
                    newRow.innerHTML = getNewRow(element);
    
                });
            }
            else{
                const newRow = table.insertRow(table.rows.length - 1);
                newRow.innerHTML = "<td align='center' colspan='5'><h2>No result found</h2></td>";
                newRow.style.color = "red";
            }
            
        }
        

    }
}

function getNewRow(element) {
    let newrow = '<form action="../controller/manage_user_process.php" method="post">' +
        "<td>" +
        '<img src="../vendor/profiles/' + element.profile_location + '" alt="" width="30">' +
        '<br>' +
        '<a href="profile_view.php?username=' + element.username + '">' + element.username + '</a>' +
        '</td>' +
        '<td>' + element.email + '</td>' +
        '<td>' + element.role + '</td>' +
        '<td>' +
        '<input type="hidden" name="username" value="' + element.username + '">' +
        '<input type="hidden" name="view" value="<?= $view ?>">'+
        '<input type="submit" name="update_user" value="Update">' +
        '';
        if(element.isExist == 'false'){
            newrow += '&nbsp;<input type="submit" name="restore" value="Restore">';
        }
        else{
            newrow += '&nbsp;<input type="submit" name="remove" value="Remove">';
            if(element.status == 'banned'){
                newrow += '&nbsp;<input type="submit" name="unban" value="Unban">';
            }else{
                newrow+= '&nbsp;<input type="submit" name="ban" value="Ban">';
            }
        }
        newrow += '</td><td>';

        if (element.isExist == 'false') newrow+= '<font color = "red">Removed Users</font>';
        else if (element.status == 'invalid') newrow+= '<font color = "orange">Invalid</font>';
        else if (element.status == 'valid') newrow+= '<font color = "green">Valid</font>';
        else if (element.status == 'banned') newrow+= '<font color = "#ff8080">Banned</font>';
        else if (element.status == 'unverified') newrow+= '<font color = "#ae7ef1">Unverified</font>';
        newrow += '</td></form>';
    return newrow;
}

  
