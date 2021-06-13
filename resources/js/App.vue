<template>
    <div>
        <nav class="navbar navbar-expand-md navbar-light bg-white shadow-sm">
         <div class="container">
            <span style="font-size:30px;cursor:pointer" onclick="openNav()">&#9776;</span>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="">
                    <span class="navbar-toggler-icon"></span>
                </button>
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                    </ul>
                    <!-- Right Side Of Navbar -->
                </div>
            </div>
        </nav>
    <!-- sidenav -->
       <div id="mySidenav" class="sidenav">
        <a href="javascript:void(0)" class="closebtn" onclick="closeNav()">&times;</a>
            <ul style="list-style:none;">
                 <li>
                      <router-link to="/" class="nav-items">Index</router-link>
                </li>
                <li>
                      <router-link to="/create" class="nav-items">Add Product</router-link>
                </li>
                <li>
                      <router-link to="/videoplayer" class="nav-items">Video Link</router-link>
                </li>
            </ul>
        </div>
    <!-- endsidenav -->
    
        <!-- component view -->
        <div class="mt-4">
               <router-view></router-view>
        </div>
    </div>
</template>
 
<script>
    import Header from './components/admin/Header.vue';
    export default {
        components:{
            Header,
        }
    }
</script>