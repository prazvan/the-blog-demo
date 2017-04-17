<template>
  <div class="row">
    <div class="col-sm-6 col-md-4" v-for="post in posts.data">
      <div class="thumbnail">
        <img v-bind:src="post.attributes.meta_data.thumbnail.uri" alt="img alt">
        <div class="caption">
          <h3>{{post.attributes.title}}</h3>
          <p class="min-height-150">{{ post.attributes.excerpt }}</p>
          <hr >
          <p>
              <!--this needs to be formatted!-->
            Published: {{post.attributes.created_at.date}}<br/>
            By Author {{post.attributes.author.name}}
          </p>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: 'blog-posts',
  data () {
    return {
      posts: []
    }
  },
  methods: {
    // cool methods go here
  },
  created: function () {
    this.$http.get('/api/posts?include=author,meta_data').then(function (response) {
      this.posts = response.data;
    })
  }
}
</script>

<!-- Add 'scoped' attribute to limit CSS to this component only -->
<style scoped>

    .min-height-150
    {
        min-height: 150px!important;
    }

</style>