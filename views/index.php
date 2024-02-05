<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <script
      defer
      src="https://cdn.jsdelivr.net/npm/vue@2.7.8/dist/vue.js"
    ></script>
    <script
      defer
      src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"
    ></script>
    <script defer src="https://unpkg.com/vue-router@3"></script>
    <script defer src="/PR8/views/app.js"></script>
    <title>PR10</title>
  </head>
  <body>
    <div id="app">
      <div>
        <ul>
          <li><a href="#" @click.prevent="page('/students');" :class="{active:$route['path']=='/students'}">students</a></li>
          <li><a href="#" @click.prevent="page('/subject');" :class="{active:$route['path']=='/subject'}">subject</a></li>
          <li><a href="#" @click.prevent="page('/progress');" :class="{active:$route['path']=='/progress'}">progress</a></li>
        </ul>
      </div>
      <div>
        <router-view></router-view>
      </div>
    </div>
  </body>
</html> 