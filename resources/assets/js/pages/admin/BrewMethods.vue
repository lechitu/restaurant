<style lang="scss">
@import "~@/abstracts/_variables.scss";

div#admin-brew-methods {
  a.add-brew-method {
    display: block;
    width: 150px;
    color: white;
    background-color: #ccc;
    text-align: center;
    border-radius: 5px;
    float: right;
    height: 45px;
    line-height: 45px;
  }

  div.new-brew-method-modal {
    position: fixed;
    top: 0;
    bottom: 0;
    left: 0;
    right: 0;
    background-color: rgba(0, 0, 0, 0.6);
    z-index: 99999;

    div.modal-box {
      width: 100%;
      max-width: 530px;
      min-width: 320px;
      padding: 20px;
      background-color: #fff;
      border: 1px solid #ddd;
      -webkit-box-shadow: 0 1px 3px rgba(50, 50, 50, 0.08);
      box-shadow: 0 1px 3px rgba(50, 50, 50, 0.08);
      -webkit-border-radius: 4px;
      border-radius: 4px;
      font-size: 16px;
      position: absolute;
      top: 50%;
      left: 50%;
      transform: translate(-50%, -50%);
      max-height: 500px;
      overflow-y: auto;

      label {
        font-weight: bold;
      }

      div.icon-selection-container {
        margin-top: 10px;
      }

      div.new-icon-container {
        text-align: center;
        cursor: pointer;
        margin-bottom: 20px;
        border-radius: 5px;
        padding: 5px;

        &.active {
          background-color: $secondary-color;
          color: white;
        }

        img.new-icon {
          display: block;
          margin: auto;
          margin-bottom: 10px;
          height: 30px;
        }
      }
    }
    a.add-method-button {
      display: block;
      width: 150px;
      color: white;
      background-color: #ccc;
      text-align: center;
      border-radius: 5px;
      margin-top: 20px;
      height: 45px;
      line-height: 45px;
    }
  }
}
</style>

<template>
  <div id="admin-brew-methods">
    <div class="grid-container">
      <div class="grid-x">
        <div class="large-8 medium-8 cell">
          <h3 class="page-header">Brew Methods</h3>
        </div>
        <div class="large-4 medium-4 cell">
          <a class="add-brew-method" v-on:click="showNewMethodModal = true">Add Brew Method</a>
        </div>
      </div>

      <div class="grid-container">
        <div class="grid-x list-header">
          <div class="large-1 medium-1 cell"></div>
          <div class="large-6 medium-6 cell">Name</div>
          <div class="large-3 medium-3 cell"></div>
        </div>
        <div class="grid-x listing" v-for="method in brewMethods">
          <div class="large-1 medium-1 cell">
            <img v-bind:src="method.icon+'.svg'" class="icon">
          </div>
          <div class="large-6 medium-6 cell">{{ method.method }}</div>
          <div class="large-3 medium-3 cell">
            <router-link :to="{ name: 'admin-brew-method', params: { id: method.id } }">More Info</router-link>
          </div>
        </div>
      </div>
    </div>
    <div
      class="new-brew-method-modal"
      v-show="showNewMethodModal"
      v-on:click="hideNewMethodModal()"
    >
      <div class="modal-box" v-on:click.stop>
        <div class="grix-x">
          <div class="large-12 medium-12 cell">
            <label>Method</label>
            <input type="text" v-model="method">
            <span
              class="validation"
              v-show="!validations.method"
            >Please enter a name for the brew method!</span>
          </div>
        </div>
        <div class="grid-x icon-selection-container">
          <div
            class="large-3 medium-3 new-icon-container cell"
            v-bind:class="{'active': icon == '/img/icons/beer'}"
            v-on:click="selectIcon('/img/icons/beer')"
          >
            <img class="new-icon" src="/img/icons/beer.svg">
            Beer
          </div>
          <div
            class="large-3 medium-3 new-icon-container cell"
            v-bind:class="{'active': icon == '/img/icons/birthday-cake'}"
            v-on:click="selectIcon('/img/icons/birthday-cake')"
          >
            <img class="new-icon" src="/img/icons/birthday-cake.svg">
            Birthday Cake
          </div>
          <div
            class="large-3 medium-3 new-icon-container cell"
            v-bind:class="{'active': icon == '/img/icons/bread'}"
            v-on:click="selectIcon('/img/icons/bread')"
          >
            <img class="new-icon" src="/img/icons/bread.svg">
            Bread
          </div>
          <div
            class="large-3 medium-3 new-icon-container cell"
            v-bind:class="{'active': icon == '/img/icons/coffee-cup'}"
            v-on:click="selectIcon('/img/icons/coffee-cup')"
          >
            <img class="new-icon" src="/img/icons/coffee-cup.svg">
            Coffee-cup
          </div>
          <div
            class="large-3 medium-3 new-icon-container cell"
            v-bind:class="{'active': icon == '/img/icons/wine'}"
            v-on:click="selectIcon('/img/icons/wine')"
          >
            <img class="new-icon" src="/img/icons/wine.svg">
            Wine
          </div>
          <div
            class="large-3 medium-3 new-icon-container cell"
            v-bind:class="{'active': icon == '/img/icons/restaurant'}"
            v-on:click="selectIcon('/img/icons/restaurant')"
          >
            <img class="new-icon" src="/img/icons/restaurant.svg">
            Restaurant
          </div>
          <div
            class="large-3 medium-3 new-icon-container cell"
            v-bind:class="{'active': icon == '/img/icons/iced-coffee'}"
            v-on:click="selectIcon('/img/icons/iced-coffee')"
          >
            <img class="new-icon" src="/img/icons/iced-coffee.svg">
            Iced-coffee
          </div>
          <div
            class="large-3 medium-3 new-icon-container cell"
            v-bind:class="{'active': icon == '/img/icons/fast-food'}"
            v-on:click="selectIcon('/img/icons/fast-food')"
          >
            <img class="new-icon" src="/img/icons/fast-food.svg">
            Fast food
          </div>
        </div>
        <div class="grid-x">
          <div class="large-12 medium-12 cell">
            <a class="add-method-button" v-on:click="addBrewMethod()">Add Brew Method</a>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
/*
    Imports the event bus to emit events.
  */
import { EventBus } from "../../event-bus.js";

export default {
  data() {
    return {
      showNewMethodModal: false,

      method: "",
      icon: "",

      validations: {
        method: true,
        icon: true
      }
    };
  },

  /*
      Sets up the page when created.
    */
  created() {
    this.$store.dispatch("loadAdminBrewMethods");
  },

  /*
      Defines the computed properties on the page.
    */
  computed: {
    brewMethods() {
      return this.$store.getters.getAdminBrewMethods;
    },
    brewMethodAddedStatus() {
      return this.$store.getters.getAdminBrewMethodAddedStatus;
    }
  },

  watch: {
    brewMethodAddedStatus: function() {
      if (this.brewMethodAddedStatus == 2) {
        EventBus.$emit("show-success", {
          notification: "Brew method added successfully!"
        });
      }
    }
  },

  /*
      Defines the methods used by the page.
    */
  methods: {
    /*
        Hides the new brew method modal
      */
    hideNewMethodModal() {
      this.method = "";
      this.icon = "";

      this.validations.method = true;
      this.validations.icon = true;

      this.showNewMethodModal = false;
    },

    /*
        Selects the new brew method icon.
      */
    selectIcon(icon) {
      this.icon = icon;
    },

    /*
        Adds a new brew method.
      */
    addBrewMethod() {
      if (this.validateNewBrewMethod()) {
        this.$store.dispatch("addAdminBrewMethod", {
          method: this.method,
          icon: this.icon
        });

        this.hideNewMethodModal();
      }
    },

    /*
        Validates a new brew method.
      */
    validateNewBrewMethod() {
      let validBrewMethod = true;

      if (this.method == "") {
        this.validations.method = false;
        validBrewMethod = false;
      } else {
        this.validations.method = true;
      }

      if (this.icon == "") {
        this.validations.icon = false;
        validBrewMethod = false;
      } else {
        this.validations.icon = true;
      }

      return validBrewMethod;
    }
  }
};
</script>
