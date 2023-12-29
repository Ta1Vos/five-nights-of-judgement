<?php


function validateCategoryValues($content, $requiredContent) {

}

function includeAdminToCards(string $type = "", $id = null): false|string {
    global $params;

    if (isAdmin() && $params[1] === "admin" && !empty($type) && isset($id)) {

        switch ($type) {
            case "product":
                return "<a href='/admin/edit/product/$id' class='z-5 text-decoration-none text-black'><button>Edit product</button></a><a href='/admin/delete/product/$id' class='z-5 text-decoration-none text-black'><button>DELETE product</button></a>";

            case "category":
                return "<a href='/admin/edit/category/$id' class='z-5 text-decoration-none text-black'><button>Edit category</button></a><a href='/admin/delete/category/$id' class='z-5 text-decoration-none text-black'><button>DELETE category</button></a>";
        }
    } else {
        logout();
        header("Location: home");
    }

    return false;
}

function addNewCard(string $cardType) {
    $card = "
<div class='col-sm-6 col-md-4 col-lg-3 card-group'>
   <div class='card bg-dark mx-2 border border-3 border-dark rounded-2' style='width: 18rem;'>
      <img src='/img/create-card.png' class='card-img-top' alt='Placeholder image'>
         <div class='card-body'>
            <h5 class='card-title text-white'>Create a new $cardType</h5>
            <hr>
            <p class='card-text text-light'>Add a new $cardType to this page.</p>
            <a href='/admin/add/$cardType' class='stretched-link'></a><br>
      </div>
   </div>
</div>";

    return $card;
}