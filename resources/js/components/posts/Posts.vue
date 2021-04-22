<template>
  <div>
    <SuccessAlert v-if="success" />

    <div class="row">
      <div class="col-md-4" v-for="post in blogPosts" :key="post.id">
        <div
          class="card mb-4 position-relative"
          style="max-height: 530px; min-height: 530px"
        >
          <!-- Average rating -->
          <div class="avg-rating">
            <star-rating
              :rating="post.avg_rating"
              :star-size="15"
              :read-only="true"
            ></star-rating>
          </div>

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

            <!-- Rating -->
            <div v-if="authUser && authUser.id !== post.user_id">
              <hr />
              <star-rating
                v-model="rating"
                :star-size="20"
                @rating-selected="setRating(post.id)"
                :animate="true"
              ></star-rating>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
import SuccessAlert from "../common/SuccessAlert";
import StarRating from "vue-star-rating";

export default {
  props: ["posts"],

  components: {
    SuccessAlert,
    StarRating,
  },

  data() {
    return {
      blogPosts: this.posts,
      success: false,
      authUser: null,
      rating: 0,
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

    async setRating(postId) {
      try {
        const res = await axios.post(`/api/posts/${postId}/rate`, {
          rating: this.rating,
        });

        this.posts.forEach((post) => {
          if (post.id === postId) {
            post.avg_rating = res.data;
          }
        });
      } catch (error) {
        console.log(error);
      }
    },
  },

  mounted() {
    this.getAuthUser();
  },
};
</script>

<style scoped>
.avg-rating {
  width: 37%;
  padding: 3px;
  position: absolute;
  height: 20px;
  line-height: 20px;
  background: #f7f7f7;
  text-align: center;
  top: -10px;
  border-radius: 2px;
  right: 8px;
  display: flex;
  justify-content: center;
  align-items: center;
}
</style>