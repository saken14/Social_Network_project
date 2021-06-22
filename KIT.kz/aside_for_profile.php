<aside>
    <div class="sidebar">
        <h2>Friends</h2>
        <div class='friends_list_container_for_profile'>
            <?php search_user_sidebar(); ?> 
        </div>
    </div>

    <div class="sidebar">
        <h2>Messages</h2>
        <hr>

        <form class='search_form' action=''>
            <input type='text' class='search_user_fr' placeholder='Search friend' name='search_user'>
            <button type='submit' class='search_btn update_photo friends' name='search_user_btn' onclick='search_change()'>Submit</button>
        </form>

        <div class='friends_list_container'>
            <?php search_user_sidebar_msgPage(); ?>
        </div>
    </div>

</aside> 