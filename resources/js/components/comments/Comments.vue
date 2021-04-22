<template>
  <div>
    <ul
      class="list-group list-group-flush"
      v-if="postComments && postComments.length"
    >
      <li
        class="list-group-item"
        v-for="comment in postComments"
        :key="comment.id"
      >
        <span class="d-block">{{ comment.body }}</span>
        <small class="d-block text-muted mt-2"
          >on <strong>{{ comment.formatted_date }}</strong> by
          <strong>{{ comment.user.name }}</strong></small
        >

        <!-- Actions -->
        <div class="btn-group btn-group-sm float-right">
          <button
            class="btn btn-secondary"
            v-if="authUser && authUser.id === comment.user_id"
            @click="setCurrentComment(comment)"
          >
            Edit
          </button>
          <button
            class="btn btn-danger"
            @click="deleteComment(comment.id)"
            v-if="
              authUser && !authUser.is_admin && authUser.id === comment.user_id
            "
          >
            Delete
          </button>

          <button
            class="btn btn-danger"
            @click="deleteComment(comment.id)"
            v-if="authUser && authUser.is_admin"
          >
            Delete
          </button>
        </div>
      </li>
    </ul>

    <h6 v-else class="mb-3 mt-3 text-muted">No comments</h6>

    <CommentAddForm
      :post-id="postId"
      @comment-added="pushNewComment"
      v-if="!currentComment"
    />
    <CommentEditForm
      :comment="currentComment"
      v-if="currentComment"
      @comment-updated="updateComment"
    />
  </div>
</template>

<script>
import CommentAddForm from "./CommentAddForm.vue";
import CommentEditForm from "./CommentEditForm.vue";

export default {
  components: { CommentAddForm, CommentEditForm },

  props: ["comments", "postId"],

  data() {
    return {
      authUser: null,
      currentComment: null,
      postComments: this.comments,
    };
  },

  methods: {
    pushNewComment(newComment) {
      this.postComments.push(newComment);
    },

    updateComment(updatedComment) {
      const index = this.postComments.findIndex(
        (comment) => comment.id === updatedComment.id
      );
      this.postComments.splice(index, 1, updatedComment);

      this.currentComment = null;
    },

    setCurrentComment(comment) {
      this.currentComment = comment;
    },

    async deleteComment(commentId) {
      if (confirm("Are you sure ?")) {
        try {
          const res = await axios.delete(`/api/comments/${commentId}`);
          this.postComments = this.postComments.filter(
            (comment) => comment.id !== commentId
          );
        } catch (error) {
          console.log(error);
        }
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
  },

  mounted() {
    this.getAuthUser();
  },
};
</script>