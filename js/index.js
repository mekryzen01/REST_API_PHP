function showdatadis() {
  const xhttp = new XMLHttpRequest();
  xhttp.open("GET", "http://localhost/Project_REST_api/service/read_wat.php");
  xhttp.send();
  xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      // console.log(this.responseText);
      var trHTML = '';
      const objects = JSON.parse(this.responseText);
      for (let object of objects) {
        trHTML += '<option value="' + object['id'] + '">' + object['wat_name'] + '</option>';
      }
      document.getElementById("watselect").outerHTML = trHTML;
    }
  };
}
showdatadis();
function showdatawatselect() {
  const xhttp = new XMLHttpRequest();
  xhttp.open("GET", "http://localhost/Project_REST_api/service/get_district.php");
  xhttp.send();
  xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      // console.log(this.responseText);
      var trHTML = '';
      const objects = JSON.parse(this.responseText);
      console.log(objects)
      trHTML += '<form action="./showtumbon.php" method="post" id="districtForm">';
      trHTML += '<label for="exampleDataList" class="form-label">ค้นหาตำบลที่ต้องการ</label>';
      trHTML += '<select id="district_idpost" class="form-control">';
      for (let object of objects) {
        trHTML += '<option value="' + object['district_id'] + '">' + "ตำบล" + object['name_th'] + '</option>';
      }
      trHTML += '</select>';
      trHTML += '<div class="col-12" style="padding-top: 25px;">';
      trHTML += '<input type="submit" class="btn btn-primary" value="search"> </input>';
      trHTML += '</div>';
      trHTML += '</form>';
      document.getElementById("formshow").outerHTML = trHTML;
      document.getElementById('districtForm').addEventListener('submit', function (e) {
        e.preventDefault(); // prevent the form from submitting normally
        const iddis = document.getElementById('district_idpost').value;
        console.log(iddis);
        this.action += '?district_id=' + iddis;
        this.submit(); // submit the form
      });
    }
  };
}
showdatawatselect();

function loadshowindex() {
  const xhttp = new XMLHttpRequest();
  xhttp.open("GET", "http://localhost/Project_REST_api/service/getwatindex.php");
  xhttp.send();
  xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      // console.log(this.responseText);
      var trHTML = '';
      const objects = JSON.parse(this.responseText);
      for (let object of objects) {

        trHTML += '<div class="col-12 col-md-4 col-lg-4 my-2">';
        trHTML += '<a href="./watByid.php?id=' + object['id'] + '" id="black">';
        trHTML += '<div class="card">';
        trHTML += '<img src="uploads/' + object['path'] + '"  class="card-img-top" alt="" width="100%" height="200px">';
        trHTML += '<div class="card-body">';
        trHTML += '<h5 class="card-title">' + object['wat_name'] + '</h5>';
        trHTML += '</div>';
        trHTML += '</div>';
        trHTML += '</a>';
        trHTML += '</div>';
      }
      document.getElementById("show").outerHTML = trHTML;
    }
  };
}
loadshowindex();
function loadTableimage() {
  const xhttp = new XMLHttpRequest();
  xhttp.open("GET", "http://localhost/Project_REST_api/service/read_image.php");
  xhttp.send();
  xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      // console.log(this.responseText);
      var trHTML = '';
      const objects = JSON.parse(this.responseText);
      for (let object of objects) {
        trHTML += '<tr>';
        trHTML += '<td hidden>' + object['rowder'] + '</td>';
        trHTML += '<td>' + object['row_num'] + '</td>';
        trHTML += '<td>' + object['wat_name'] + '</td>';
        trHTML += '<td><img src="../uploads/' + object['path'] + '" alt="" width="50%" height="200px"></td>';
        trHTML += '<td><button type="button" class="btn btn-danger" onclick="imageDelete(' + object['rowder'] + ')">Del</button></td>';
        trHTML += "</tr>";
      }
      document.getElementById("mytableimage").innerHTML = trHTML;
    }
  };
}
loadTableimage();
function imageDelete(rowder) {
  const xhttp = new XMLHttpRequest();
  xhttp.open("DELETE", "http://localhost/Project_REST_api/service/delete_image.php");
  xhttp.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
  xhttp.send(JSON.stringify({
    "rowder": rowder
  }));
  xhttp.onreadystatechange = function () {
    if (this.readyState == 4) {
      const objects = JSON.parse(this.responseText);
      Swal.fire({
        icon: 'success',
        title: objects['message'],
        showConfirmButton: true,
      });
      loadTableimage();
    }
  };
}
///////////////////////////////// START FUNCTION USER //////////////////////////////////////////////////////////////////////////////////////////////
function loadTable() {
  const xhttp = new XMLHttpRequest();
  xhttp.open("GET", "http://localhost/Project_REST_api/service/read_user.php");
  xhttp.send();
  xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      // console.log(this.responseText);
      var trHTML = '';
      const objects = JSON.parse(this.responseText);
      for (let object of objects) {
        trHTML += '<tr>';
        trHTML += '<td hidden>' + object['iduser'] + '</td>';
        trHTML += '<td>' + object['row_num'] + '</td>';
        trHTML += '<td>' + object['Name'] + '</td>';
        trHTML += '<td>' + object['Sername'] + '</td>';
        trHTML += '<td>' + object['email'] + '</td>';
        trHTML += '<td>' + object['status_name'] + '</td>';
        trHTML += '<td>' + object['Timecreate'] + '</td>';
        trHTML += '<td><button type="button" class="btn btn-secondary" onclick="showUserEditBox(' + object['iduser'] + ')">Edit</button>';
        trHTML += '<button type="button" class="btn btn-danger" onclick="userDelete(' + object['iduser'] + ')">Del</button></td>';
        trHTML += "</tr>";
      }
      document.getElementById("mytable").innerHTML = trHTML;
    }
  };
}
loadTable();
///////////////////////////////////////////// Show BOX insert ///////////////////////////////////
function showUserEditBox(iduser) {
  console.log(iduser);
  const xhttp = new XMLHttpRequest();
  xhttp.open("GET", "http://localhost/Project_REST_api/service/read_userbyid.php?iduser=" + iduser);
  xhttp.send();
  xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      const objects = JSON.parse(this.responseText);
      console.log(objects)
      Swal.fire({
        title: 'Edit User',
        html:
          '<input id="iduser" type="hidden" value=' + objects['iduser'] + '>' +
          '<input id="Name" class="form-control my-2" placeholder="ชื่อ" value="' + objects['Name'] + '">' +
          '<input id="Sername" class="form-control my-2" placeholder="นามสกุล" value="' + objects['Sername'] + '">' +
          '<input id="email" type="email" class="form-control my-2" placeholder="อีเมล์" value="' + objects['email'] + '">' +
          '<input id="password" type="password" class="form-control my-2" placeholder="รหัสผ่าน" value="' + objects['password'] + '">',
        focusConfirm: false,
        preConfirm: () => {
          userEdit();
        }
      })
    }
  };
}
//// Edit
function userEdit() {
  const iduser = document.getElementById("iduser").value;
  const Name = document.getElementById("Name").value;
  const Sername = document.getElementById("Sername").value;
  const email = document.getElementById("email").value;
  const password = document.getElementById("password").value;

  const xhttp = new XMLHttpRequest();
  xhttp.open("PATCH", "http://localhost/Project_REST_api/service/update_user.php");
  xhttp.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
  xhttp.send(JSON.stringify({
    "iduser": iduser, "Name": Name, "Sername": Sername, "email": email, "password": password
  }));
  xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      const objects = JSON.parse(this.responseText);
      Swal.fire(objects['message']);
      loadTable();
    }
  };
}
///// delete
function userDelete(iduser) {
  const xhttp = new XMLHttpRequest();
  xhttp.open("DELETE", "http://localhost/Project_REST_api/service/delete_user.php");
  xhttp.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
  xhttp.send(JSON.stringify({
    "iduser": iduser
  }));
  xhttp.onreadystatechange = function () {
    if (this.readyState == 4) {
      const objects = JSON.parse(this.responseText);
      Swal.fire({
        icon: 'success',
        title: objects['message'],
        showConfirmButton: true,
      });
      loadTable();
    }
  };
}
//////////////////////////////////////////////////////////////////////// END USER FUNCTION///////////////////////////////////////////////////////////////
function loadTablewat() {
  const xhttp = new XMLHttpRequest();
  xhttp.open("GET", "http://localhost/Project_REST_api/service/read_wat.php")
  xhttp.send()
  xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      // console.log(this.responseText)
      var trHTML = ''
      const data = JSON.parse(this.responseText)
      for (let object of data) {
        trHTML += '<tr>'
        trHTML += '<td hidden>' + object['id'] + '</td>'
        trHTML += '<td>' + object['row_num'] + '</td>'
        trHTML += '<td>' + object['wat_name'] + '</td>'
        trHTML += '<td>' + object['detail'] + '</td>'
        trHTML += '<td>' + object['address'] + '</td>'
        trHTML += '<td hidden>' + object['district_id'] + '</td>'
        trHTML += '<td>' + object['name_th'] + '</td>'
        trHTML += '<td>' + object['latitude'] + '</td>'
        trHTML += '<td>' + object['longitude'] + '</td>'
        trHTML += '<td><button type="button" class="btn btn-secondary" onclick="showWatEditBox(' + object['id'] + ')">Edit</button>';
        trHTML += '<button type="button" class="btn btn-danger" onclick="watDelete(' + object['id'] + ')">Del</button></td>';
        trHTML += '</tr>'
      }
      document.getElementById("mytablewat").innerHTML = trHTML;
    }
  }
}
loadTablewat();

function getdata(url) {
  return new Promise(function (resolve, reject) {
    const xhttp = new XMLHttpRequest();
    xhttp.open("GET", url);
    xhttp.send();
    xhttp.onreadystatechange = function () {
      if (this.readyState === 4 && this.status === 200) {
        const data = JSON.parse(this.responseText);
        resolve(data);
      }
    }
  });
}

function showWatEditBox(id) {
  Promise.all([
    getdata("http://localhost/Project_REST_api/service/read_watbyid.php?id=" + id),
    getdata("http://localhost/Project_REST_api/service/get_district.php")
  ]).then(function ([watData, districtData]) {
    const districtOptions = districtData.map(function (district) {
      return '<option value="' + district['district_id'] + '">' + district['name_th'] + '</option>';
    }).join("");

    Swal.fire({
      title: 'Edit Wat',
      html:
        '<div class="row">' +
        '<div class="col-12"><input id="id" type="hidden" value=' + watData['id'] + '></div>' +
        '<div class="col-12"><input id="wat_name" class="form-control my-2" placeholder="ชื่อวัด" value="' + watData['wat_name'] + '"></div>' +
        '<div class="col-12"><textarea id="detail" class="form-control my-2" placeholder="รายละเอียด" value="' + watData['detail'] + '">' + watData['detail'] + '</textarea></div>' +
        '<div class="col-12"><input id="address" type="text" class="form-control my-2" placeholder="ที่อยู่" value="' + watData['address'] + '" ></div>' +
        '<div class="col-12"><select id="district_id" class="form-select my-2">' + districtOptions + '</select></div>' +
        '<div class="col-12"><input id="latitude" type="text" class="form-control my-2" placeholder="ละติจูด" value="' + watData['latitude'] + '"></div>' +
        '<div class="col-12"><input id="longitude" type="text" class="form-control my-2" placeholder="ลองติจูด" value="' + watData['longitude'] + '"></div>' +
        '</div>',
      focusConfirm: false,
      preConfirm: () => {
        watEdit();
      }
    });
  }).catch(function (error) {
    console.log(error);
  });
}
//// Edit
function watEdit() {
  const id = document.getElementById("id").value;
  const wat_name = document.getElementById("wat_name").value;
  const detail = document.getElementById("detail").value;
  const address = document.getElementById("address").value;
  const district_id = document.getElementById("district_id").value;
  const latitude = document.getElementById("latitude").value;
  const longitude = document.getElementById("longitude").value;

  const xhttp = new XMLHttpRequest();
  xhttp.open("PATCH", "http://localhost/Project_REST_api/service/update_wat.php");
  xhttp.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
  xhttp.send(JSON.stringify({
    "id": id, "wat_name": wat_name, "detail": detail, "address": address, "district_id": district_id, "latitude": latitude, "longitude": longitude
  }));
  xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      const objects = JSON.parse(this.responseText);
      Swal.fire({
        icon: 'success',
        title: objects['message'],
        showConfirmButton: true,
      });
      loadTablewat();
    }
  };
}
///// delete
function watDelete(id) {
  const xhttp = new XMLHttpRequest();
  xhttp.open("DELETE", "http://localhost/Project_REST_api/service/delete_wat.php");
  xhttp.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
  xhttp.send(JSON.stringify({
    "id": id
  }));
  console.log(id)
  xhttp.onreadystatechange = function () {
    if (this.readyState == 4) {
      const objects = JSON.parse(this.responseText);
      Swal.fire({
        icon: 'success',
        title: objects['message'],
        showConfirmButton: true,
      });
      loadTablewat()
    }
  };
}
//// insert wat
function showWatCreateBox() {
  Promise.all([
    getdata("http://localhost/Project_REST_api/service/get_district.php")
  ]).then(function ([districtData]) {
    const districtOptions = districtData.map(function (district) {
      return '<option value="' + district['district_id'] + '">' + district['name_th'] + '</option>';
    }).join("");
    Swal.fire({
      title: 'Edit Wat',
      html:
        '<div class="row">' +
        '<div class="col-12"><input id="id" type="hidden"></div>' +
        '<div class="col-12"><input id="wat_name" class="form-control my-2" placeholder="ชื่อวัด"></div>' +
        '<div class="col-12"><textarea id="detail" class="form-control my-2" placeholder="รายละเอียด" ></textarea></div>' +
        '<div class="col-12"><input id="address" type="text" class="form-control my-2" placeholder="ที่อยู่"></div>' +
        '<div class="col-12"><select id="district_id" class="form-select my-2">' + districtOptions + '</select></div>' +
        '<div class="col-12"><input id="latitude" type="text" class="form-control my-2" placeholder="ละติจูด" ></div>' +
        '<div class="col-12"><input id="longitude" type="text" class="form-control my-2" placeholder="ลองติจูด"></div>' +
        '</div>',
      focusConfirm: false,
      preConfirm: () => {
        watCreate();
      }
    });
  }).catch(function (error) {
    console.log(error);
  });
}
///->
function watCreate() {
  const wat_name = document.getElementById("wat_name").value;
  const detail = document.getElementById("detail").value;
  const address = document.getElementById("address").value;
  const district_id = document.getElementById("district_id").value;
  const latitude = document.getElementById("latitude").value;
  const longitude = document.getElementById("longitude").value;

  const xhttp = new XMLHttpRequest();
  xhttp.open("POST", "http://localhost/Project_REST_api/service/insert_wat.php");
  xhttp.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
  xhttp.send(JSON.stringify({
    "wat_name": wat_name, "detail": detail, "address": address, "district_id": district_id, "latitude": latitude, "longitude": longitude
  }));
  xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      const objects = JSON.parse(this.responseText);
      Swal.fire({
        icon: 'success',
        title: objects['message'],
        showConfirmButton: true,
      }
      );
      loadTablewat();
    }
  };
}
//// 
function showUserCreateBox() {
  Swal.fire({
    title: 'สมัครสมาชิก',
    html:
      '<input id="id" type="hidden">' +
      '<input id="Name" class="form-control my-2" placeholder="ชื่อ">' +
      '<input id="Sername" class="form-control my-2" placeholder="นามกสุล">' +
      '<input type="email" id="email" class="form-control my-2" placeholder="อีเมล์">' +
      '<input type="password" id="password" class="form-control my-2" placeholder="รหัส">',
    focusConfirm: false,
    preConfirm: () => {
      userCreate();
    }
  })
}
///->
function userCreate() {
  const Name = document.getElementById("Name").value;
  const Sername = document.getElementById("Sername").value;
  const email = document.getElementById("email").value;
  const password = document.getElementById("password").value;

  const xhttp = new XMLHttpRequest();
  xhttp.open("POST", "http://localhost/Project_REST_api/service/Register_user.php");
  xhttp.setRequestHeader("Content-Type", "application/json;charset=UTF-8");
  xhttp.send(JSON.stringify({
    "Name": Name, "Sername": Sername, "password": password, "email": email
  }));
  xhttp.onreadystatechange = function () {
    if (this.readyState == 4 && this.status == 200) {
      const objects = JSON.parse(this.responseText);
      Swal.fire({
        icon: 'success',
        title: objects['message'],
        showConfirmButton: false,
      }
      );
      loadTable();
    }
  };
}
function saveFile() {
  var fl = document.getElementById("myfile").files;
  var fw = document.getElementById("idwat").value;

  if (fl.length > 0) {
    var fd = new FormData();

    fd.append("file", fl[0]);
    fd.append("idwat", fw);

    var xhr = new XMLHttpRequest();

    xhr.open('POST', 'http://localhost/Project_REST_api/service/upload_image.php', true);

    xhr.send(fd);

    xhr.onreadystatechange = function () {
      if (xhr.readyState == 4 && xhr.status == 200) {
        var response = JSON.parse(xhr.responseText);

        document.getElementById('fileupload_form').reset();

        if (response.success) {
          document.getElementById('message_box').innerHTML = response.success;
        }
        else if (response.size_error) {
          document.getElementById('message_box').innerHTML = response.size_error;
        }
        else if (response.exists_error) {
          document.getElementById('message_box').innerHTML = response.exists_error;
        }
        else if (response.extension_error) {
          document.getElementById('message_box').innerHTML = response.extension_error;
        }
      }
    };
  }
  else {
    alert('Please Select File !!');
  }
}



  ///