<template>
  <div>
    <form @submit.prevent="update">
      <div class="form-group">
        <label for="title">Title</label>
        <input
          type="text"
          name="title"
          id="title"
          class="form-control"
          v-model="data.title"
        />

        <span
          class="error text-danger"
          v-if="errors && errors['title']"
          v-text="errors['title'][0]"
        ></span>
      </div>

      <div class="form-group">
        <label for="video">Video</label>
        <input
          type="file"
          name="video"
          id="video"
          class="form-control"
          @change="handleFile"
        />

        <span
          class="error text-danger"
          v-if="errors && errors['video']"
          v-text="errors['video'][0]"
        ></span>
      </div>

      <div class="form-group">
        <label for="description">Description</label>
        <textarea
          rows="5"
          type="file"
          name="description"
          id="description"
          class="form-control"
          v-model="data.description"
        ></textarea>

        <span
          class="error text-danger"
          v-if="errors && errors['description']"
          v-text="errors['description'][0]"
        ></span>
      </div>

      <div class="form-group">
        <input
          type="submit"
          class="btn btn-success"
          value="Update"
          :disabled="loading"
        />
      </div>
    </form>

    <SuccessAlert v-if="success" />
  </div>
</template>

<script>
import SuccessAlert from "../common/SuccessAlert";

export default {
  props: ["post"],

  components: {
    SuccessAlert,
  },

  data() {
    const { id, title, description } = this.post;

    return {
      success: false,
      loading: false,
      errors: null,
      data: {
        id,
        title,
        video: "",
        description,
      },
    };
  },

  methods: {
    handleFile(e) {
      this.data.video = e.target.files[0];
    },

    async update() {
      this.loading = true;
      try {
        const { title, description, video } = this.data;

        const fd = new FormData();

        fd.append("title", title);
        fd.append("description", description);
        if (video) {
          fd.append("video", video);
        }
        fd.append("_method", "PUT");

        const res = await axios.post(`/api/posts/${this.data.id}`, fd);

        this.success = true;
        this.loading = false;

        this.hideAlert();

        window.location.href = `/posts`;
      } catch (error) {
        if (error.response.status === 422) {
          this.errors = error.response.data.errors;
          this.error = null;
        }

        this.success = false;
        this.loading = false;
      }
    },

    hideAlert() {
      if (this.success) {
        setTimeout(() => (this.success = false), 3000);
      }
    },
  },
};
</script>