<style lang="scss">
@import "~@/abstracts/_variables.scss";

div#profile-page {
  position: fixed;
  top: 0;
  bottom: 0;
  left: 0;
  right: 0;
  background-color: white;
  z-index: 99999;
  overflow: auto;

  img#back {
    float: right;
    margin-top: 20px;
    margin-right: 20px;
  }

  div.centered {
    margin: auto;
  }

  h2.page-title {
    color: #342c0c;
    font-size: 36px;
    font-weight: 900;
    font-family: "Lato", sans-serif;
    margin-top: 60px;
  }

  label.form-label {
    font-family: "Lato", sans-serif;
    text-transform: uppercase;
    font-weight: bold;
    color: black;
    margin-top: 10px;
    margin-bottom: 10px;
  }

  a.update-profile-button {
    display: block;
    text-align: center;
    height: 50px;
    color: white;
    border-radius: 3px;
    font-size: 18px;
    font-family: "Lato", sans-serif;
    background-color: #a7be4d;
    line-height: 50px;
    margin-bottom: 50px;
  }
}
</style>

<template>
  <transition name="scale-in-center">
    <div id="profile-page">
      <router-link :to="{ name: 'cafes' }">
        <img src="/img/close-modal.svg" id="back">
      </router-link>

      <div class="grid-container">
        <div class="grid-x grid-padding-x">
          <div class="large-8 medium-9 small-12 cell centered">
            <h2 class="page-title">Profile</h2>
          </div>
        </div>
      </div>

      <div class="grid-container">
        <div class="grid-x grid-padding-x">
          <loader v-show="userLoadStatus == 1" :width="100" :height="100"></loader>
        </div>
      </div>

      <div class="grid-container" v-show="userLoadStatus == 2">
        <div class="grid-x grid-padding-x">
          <div class="large-8 medium-10 small-12 cell centered">
            <label class="form-label">Favorite Coffee</label>
            <textarea v-model="favorite_coffee"></textarea>
          </div>
        </div>
        <div class="grid-x grid-padding-x">
          <div class="large-8 medium-10 small-12 cell centered">
            <label class="form-label">Flavor Notes</label>
            <textarea v-model="flavor_notes"></textarea>
          </div>
        </div>
        <div class="grid-x grid-padding-x">
          <div class="large-8 medium-10 small-12 cell centered">
            <label class="form-label">Visibility</label>
            <select id="public-visibility" v-model="profile_visibility">
              <option value="0">Private</option>
              <option value="1">Public</option>
            </select>
          </div>
        </div>
        <div class="grid-x grid-padding-x">
          <div class="large-8 medium-10 small-12 cell centered">
            <label class="form-label">City</label>
            <input type="text" v-model="city">
          </div>
        </div>

        <div class="grid-x grid-padding-x">
          <div class="large-8 medium-10 small-12 cell centered">
            <a class="update-profile-button" v-on:click="updateProfile()">Update Profile</a>
          </div>
        </div>
      </div>
    </div>
  </transition>
</template>

<script>
/*
    Imports the event bus
  */
import { EventBus } from "../event-bus.js";

/*
    Imports the components used by the page.
  */
import Loader from "../components/global/Loader.vue";

export default {
  /*
      Defines the components used in the page.
    */
  components: {
    Loader
  },

  /*
      Defines the data used by the page.
    */
  data() {
    return {
      favorite_coffee: "",
      flavor_notes: "",
      profile_visibility: 0,
      city: ""
    };
  },

  /*
      Defines the data to watch in the page.
    */
  watch: {
    /*
        When the user load status changes, and is successful,
        set the fields accordingly.
      */
    userLoadStatus: function() {
      if (this.userLoadStatus == 2) {
        this.setFields();
      }
    },

    /*
        When the user is successfully updated, show the
        notification.
      */
    userUpdateStatus: function() {
      if (this.userUpdateStatus == 2) {
        EventBus.$emit("show-success", {
          notification: "Your profile has been updated successfully!"
        });
      }
    }
  },

  /*
      On the created lifecycle hook if the user has been loaded,
      set the user fields to be edited.
    */
  created() {
    if (this.userLoadStatus == 2) {
      this.setFields();
    }
  },

  /*
      Defines the computed fields used in the page.
    */
  computed: {
    /*
        Gets the authenticated user.
      */
    user() {
      return this.$store.getters.getUser;
    },

    /*
        Gets the user load status.
      */
    userLoadStatus() {
      return this.$store.getters.getUserLoadStatus();
    },

    /*
        Gets the user update status
      */
    userUpdateStatus() {
      return this.$store.getters.getUserUpdateStatus;
    }
  },

  /*
      Defines the methods used by the component.
    */
  methods: {
    /*
        Sets the editable fields.
      */
    setFields() {
      this.profile_visibility = this.user.profile_visibility;
      this.favorite_coffee = this.user.favorite_coffee;
      this.flavor_notes = this.user.flavor_notes;
      this.city = this.user.city;
    },

    /*
        Updates the user's profile.
      */
    updateProfile() {
      /*
          if the profile is valid, dispatch the edits to be
          stored in the API.
        */
      if (this.validateProfile()) {
        this.$store.dispatch("editUser", {
          profile_visibility: this.profile_visibility,
          favorite_coffee: this.favorite_coffee,
          flavor_notes: this.flavor_notes,
          city: this.city
        });
      }
    },

    /*
        Validates the profile
      */
    validateProfile() {
      return true;
    }
  }
};
</script>
