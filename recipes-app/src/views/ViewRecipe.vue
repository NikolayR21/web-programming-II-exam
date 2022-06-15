<!-- eslint-disable -->
<template>
  <div class="recipe-container">
    <Loader v-if="!recipe" />
    <div v-if="recipe" class="recipe">
      <div class="controls">
        <div class="back-link" @click="goBack">
          <i class="fa-solid fa-chevron-left"></i>
        </div>

        <div v-if="isAuth" class="crud">
          <div class="delete"><i class="fa-solid fa-trash"></i></div>
          <div class="edit"><i class="fa-solid fa-pen-to-square"></i></div>
        </div>
      </div>
      <img :src="recipe.image" />
      <div class="recipe-info">
        <h2>{{ recipe.title }}</h2>
        <p class="source" v-if="!recipe.sourceUrl && recipe.user">
          {{ recipe.user.firstName }} {{ recipe.user.lastName }}
        </p>
        <p class="source" v-if="recipe.sourceUrl">
          Source: <a :href="recipe.sourceUrl">{{ recipe.sourceUrl }}</a>
        </p>
        <p class="date">
          {{ new Date(recipe.updated_at).toLocaleDateString() }}
        </p>
        <div class="meta">
          <ul>
            <li>
              <span>Likes</span><span>{{ recipe.likes }}</span>
            </li>
            <li>
              <span>Ready time</span><span>{{ recipe.readyTime }} mins</span>
            </li>
            <li>
              <span>Servings</span><span>{{ recipe.servings }}</span>
            </li>
          </ul>
        </div>
        <div class="summary">
          <p v-html="recipe.summary"></p>
        </div>
        <div class="ingredients">
          <details open>
            <summary><h2>Ingredients</h2></summary>
            <ul>
              <li v-for="ingredient in recipe.ingredients" :key="ingredient.id">
                - {{ ingredient.ingredient.amount }} {{ ingredient.name }}
              </li>
            </ul>
            <button>Add to shopping list</button>
          </details>
        </div>
        <div class="steps">
          <h2>Steps</h2>
          <ol>
            <li v-for="step in JSON.parse(recipe.steps)" :key="step.number">
              <h3>Step</h3>
              <p>{{ step.step }}</p>
            </li>
          </ol>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
/*eslint-disable*/
import Loader from "../components/Loader.vue";

export default {
  name: "ViewRecipe",
  components: {
    Loader,
  },
  methods: {
    goBack() {
      this.$router.go(-1);
    },
    scrollTop() {
      window.scrollTo(0, 0);
    },
  },
  computed: {
    recipe() {
      return this.$store.state.recipe.selectedRecipe;
    },
    recipeId() {
      return this.$route.params.recipeId;
    },
    user(){
      const user = this.$store.state.user.user;
      return user;
    },
    isAuth(){
      return this.$store.state.user.authenticated;
    }
  },
  mounted() {
    window.scrollTo(0, 0);
    this.$store.dispatch("getRecipe", this.recipeId);
  },
  destroyed() {
    this.$store.dispatch("getRecipe");
  },
};
</script>

<style lang="scss" scoped>
.recipe-container {
  min-height: calc(100vh - 7rem);

  .recipe {
    width: 100%;
    position: relative;

    .controls {
      display: flex;
      justify-content: space-between;
      position: absolute;
      width: 100%;
      padding: 1rem;

      .back-link,
      .delete,
      .edit {
        display: flex;
        background: #fff;
        border-radius: 50%;
        height: 2.5rem;
        width: 2.5rem;
        justify-content: center;
        align-items: center;
      }

      .back-link {
        color: #80b700;
      }

      .crud {
        display: flex;

        .delete {
          margin-right: 0.5rem;
          color: red;
        }

        .edit {
          color: #80b700;
        }
      }
    }

    img {
      aspect-ratio: 16/9;
      width: 100%;
    }

    &-info {
      padding: 1rem;

      .date,
      .source {
        font-size: 0.85rem;
        margin: 0.5rem 0;
      }

      .source {
        text-overflow: ellipsis;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
      }

      .meta {
        margin: 1rem 0;
        ul {
          display: flex;
          justify-content: space-between;
          list-style: none;
          li {
            display: flex;
            flex-direction: column;
            justify-content: flex-start;

            span {
              &:nth-child(1) {
                font-weight: bold;
              }
            }
          }
        }
      }

      .ingredients {
        margin: 1rem 0;

        details {
          border: 1px solid black;
          border-left: none;
          border-right: none;
          border: 1px solid black;
          border-left: none;
          border-right: none;
          margin: 0 -1rem;
          padding: 0 1rem;

          summary {
            display: flex;
            margin: 0 -1rem;
            padding: 1rem;
          }
          ul {
            list-style: none;
            margin: 0.5rem 0;
            li {
              padding: 0.5rem;
            }
          }

          button {
            width: 100%;
            padding: 1rem;
            color: #80b700;
            font-weight: bold;
            border: none;
            box-shadow: inset 0 0 0px 2px #80b700;
            background: #fff;
            margin-bottom: 1rem;
            border-radius: 4px;
          }
        }
      }

      .steps{
        margin: .5rem 1rem;
        
        ol{
          li{
            margin: 1rem 0;
            &::marker{
              font-weight: bold;
            }

            h3{
              margin-bottom: .5rem;
            }
          }
        }
      }
    }
  }
}
</style>