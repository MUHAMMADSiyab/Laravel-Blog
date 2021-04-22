<template>
  <div>
    <SuccessAlert v-if="success" />

    <div class="row">
      <div class="col-md-4" v-for="post in blogPosts" :key="post.id">
        <div class="card mb-4" style="max-height: 470px; min-height: 470px">
          <div class="card-header">
            <h4 class="card-title">{{ post.title }}</h4>
          </div>
          <div class="card-body">
            <video
              class="embed-responsive embed-responsive-16by9"
              controls
              :src="`/storage/posts/${post.video}`"
            ></video>

            <p class="text-justify">{{ post.summary }}</p>
            <a :href="`/posts/${post.id}`" class="btn btn-info btn-sm"
              >Read full post</a
            >
          </div>
          <div class="card-footer">
            <small class="text-muted">{{ post.formatted_date }}</small>

            <!-- Actions -->
            <div
              class="btn-group btn-group-sm"
              v-if="
                authUser && !authUser.is_admin && authUser.id === post.user_id
              "
            >
              <a :href="`/posts/${post.id}/edit`" class="btn btn-secondary"
                >Edit</a
              >
              <button class="btn btn-danger" @click="deletePost(post.id)">
                Delete
              </button>
            </div>

            <div
              class="btn-group btn-group-sm"
              v-if="authUser && authUser.is_admin"
            >
              <a :href="`/posts/${post.id}/edit`" class="btn btn-secondary"
                >Edit</a
              >
              <button class="btn btn-danger" @click="deletePost(post.id)">
                Delete
              </button>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import SuccessAlert from "../common/SuccessAlert";

export default {
  props: ["posts"],

  components: {
    SuccessAlert,
  },

  data() {
    return {
      blogPosts: this.posts,
      success: false,
      authUser: null,
    };
  },
  methods: {
    handleFile(e) {
      this.data.video = e.target.files[0];
    },

    hideAlert() {
      if (this.success) {
        setTimeout(() => (this.success = false), 3000);
      }
    },

    async getAuthUser() {
      try {
        const res = await axios.get("/api/user");
        this.authUser = res.data;
      } catch (error) {
        console.log(error);
      }
    },

    async deletePost(postId) {
      if (confirm("Are you sure ?")) {
        try {
          const res = await axios.delete(`/api/posts/${postId}`);

          // update posts
          this.blogPosts = this.blogPosts.filter((post) => post.id !== postId);
          this.success = true;
          this.hideAlert();
        } catch (error) {
          this.success = false;
          console.log(error);
        }
      }
    },
  },

  mounted() {
    this.getAuthUser();
  },
};
</script>