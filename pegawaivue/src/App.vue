<template>
  <nav class="navbar navbar-expand-lg navbar-dark bg-orange">
    <router-link :to="{name: 'login'}" class="navbar-brand judul"> Sistem Informasi Pegawai</router-link>
    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle Navigation">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="navbarNav">
      <ul class="navbar-nav ml-auto" id="navkanan">
        <li class="nav-item">
          <router-link :to="{name: 'register'}" class="nav-link" href="">Register</router-link>
        </li>
        <li class="nav-item">
          <router-link :to="{name: 'login'}" class="nav-link" href="#">Login</router-link>
        </li>
      </ul>
    </div>
  </nav>
  <router-view />
</template>

<script>
export default {

}
</script>

<style>
body {
  background: whitesmoke!important;;
}

#navkanan {
  margin-left: 950px;
}

.judul {
  padding: 20px;
}

.bg-orange {
  background: midnightblue;
}

</style>
