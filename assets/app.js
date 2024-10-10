$(".js-form-login").on("submit", function (event) {
  event.preventDefault();
  var user = $(".user").val();
  var password = $(".password").val();

  $.ajax({
    url: "../api/login.php",
    type: "POST",
    data: { user: user, password: password },
    dataType: "json",
    success: function (response) {
      if (response.success) {
        window.location.href = response.redirect;
      } else {
        $(".message").html(
          '<div class="alert alert-danger">' + response.message + "</div>"
        );
      }
    },
    error: function (xhr, status, error) {
      $(".message").html(
        '<div class="alert alert-danger">Error: ' + error + "</div>"
      );
    },
  });
});

$(".js-button-logout").click(function () {
  var role = $(this).data("role");
  $.ajax({
    url: "../api/logout.php",
    type: "POST",
    data: { role: role },
    dataType: "json",
    success: function (response) {
      if (response.success) {
        window.location.href = response.redirect;
      } else {
        $(".message").html(
          '<div class="alert alert-danger">' + response.message + "</div>"
        );
      }
    },
    error: function (error) {
      $(".message").html(
        '<div class="alert alert-danger">Error: ' + error + "</div>"
      );
    },
  });
});

// pagination
function fetchData(page) {
  $.ajax({
    url: "../api/get_data.php",
    type: "GET",
    data: { page: page },
    success: function (response) {
      $(".js-show-table").html(response);
    },
    error: function () {
      alert("Lỗi!!");
    },
  });
}

$(document).ready(function () {
  fetchData(1);
});

$(document).on("click", ".js-button-pagination", function () {
  var page = $(this).data("page");
  fetchData(page);
});

// Delete
$(document).on("click", ".js-button-delete", function () {
  var id = $(this).data("id");
  var page = $(this).data("page");

  $.ajax({
    url: "../api/delete_data.php",
    type: "GET",
    data: { id: id, page: page },
    success: function (response) {
      fetchData(page);
    },
    error: function () {
      alert("Lỗi!!");
    },
  });
});

// Search
function searchData(key, page = 1) {
  $.ajax({
    url: "../api/search_data.php",
    type: "GET",
    data: { key: key, page: page },
    success: function (response) {
      $(".js-show-search").html(response);
    },
    error: function () {
      alert("Lỗi!!");
    },
  });
}

$(document).ready(function () {
  $(".js-input-search").keyup(function () {
    var key = $(this).val();
    let timeout = null;
    clearTimeout(timeout);
    timeout = setTimeout(function () {
      searchData(key);
    }, 500);
  });
});

$(document).on("click", ".js-button-paginationSearch", function () {
  var page = $(this).data("page");
  var key = $(this).data("key");
  searchData(key, page);
});
