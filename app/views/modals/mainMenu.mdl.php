<nav class="headerBar position-is-fixed bg-is-main-color">
    <input class="menu-btn" type="checkbox" id="menu-btn" />
    <label class="menu-icon" for="menu-btn">
        <span class="navicon"></span>
    </label>
    <ul class="row center-in-row menu">
        <li class="offset-1 col-xxs-1" id="logo">
            <a href="/">
                <img class="logo" src="<?php echo $aConfigs['logo']['url']; unset($aConfigs['logo']) ?>">
            </a>
        </li>
        <li class="col-xxs-1" onClick="openCategories()">
            <a href="#">Catégories</a>
            <ul id="submenu">
                <?php foreach ( $aConfigs as $aKeyCategories => $aCategories ): ?>
                    <?php foreach ( $aCategories as $sKey => $sValue ): ?>
                        <li class="bg-is-main-color">
                            <a href="<?php echo $sValue ?>">
                                <?php echo $aKeyCategories ?>
                            </a>
                        </li>
                    <?php endforeach; ?>
                <?php endforeach; ?>
            </ul>
        </li>
        <li class="offset-3 col-xxs-2 col-lg-2" id="search-input">
            <form action="/front/index/search" method="POST">
                <input class="search-input bg-is-main-color" type="text" name="search">
                <input class="search-icon" type="submit" value=""/>
            </form>
        </li>
        <li class="col-xxs-1">
            <a href="/front/cart">
                <input class="cart-icon" type="submit" name="search" value="" />
            </a>
        </li>
        <li class="col-xxs-1" style="margin-right: 15px">
            <a href="">
                Connexion
            </a>
        </li>
        <li class="col-xxs-1">
            <a href="/front/user/subscribe">
                Inscription
            </a>
        </li>
    </ul>
</nav>