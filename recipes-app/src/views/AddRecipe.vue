<template>
  <div class="container form-wrap">
    <form @submit.prevent="uploadRecipe" method="POST" enctype="multipart/form-data" name="addRecipe">
      <h2>Add a recipe</h2>
      <div class="inputs">
        <div class="input">
          <label for="title">Title</label>
          <input type="text" name="title" id="title" v-model="recipe.title" placeholder="Recipe title">
        </div>
        <div class="input">
          <label for="image">Image</label>
          <input type="file" @change="uploadImage" accept="image/*" name="image" id="image">
        </div>
        <div class="input">
          <label for="servings">Servings</label>
          <input type="number" name="servings" class="servings" id="servings" placeholder="Recipe servings">
        </div>
        <div class="input">
          <label for="readyTime">Ready Time (in min)</label>
          <input type="number" name="readyTime" class="readyTime" id="readyTime" placeholder="Ready time in minutes">
        </div>
        <div class="input">
          <label for="summary">Summary</label>
          <textarea name="summary" id="summary" rows="3" placeholder="Recipe summary (optional)"></textarea>
        </div>
        <div class="input">
          <label for="ingredient">Ingredients</label>
          <div class="ingredients">
            <details v-for="(ingredient, i) in recipe.extendedIngredients" :key="i" class="addedIngr">
              <summary>
                <input list="ingredients" v-model="ingredient.name">
                <button type="button" class="remove" @click.prevent="removeIngr(i)">Remove</button>
              </summary>
              <input type="number" name="amount" v-model="ingredient.amount">
              <input type="text" name="measurement" v-model="ingredient.measurement">

            </details>
          </div>
          <datalist id="ingredients">
            <option v-for="(ingredient, i) in ingredients" :key="i" :value="ingredient.name">{{ingredient.name}}</option>
          </datalist>
          <div class="newIngr">
            <input list="ingredients" name="ingredient" v-model="newIngr" placeholder="Name">
            <input type="number" name="amount" v-model="amount" placeholder="Amount">
            <input type="text" name="measurement" v-model="measurement" placeholder="Measurement">
            <button type="button" @click.prevent="addIngr">Add</button>
          </div>
        </div>
        <div class="input">
          <label class="stepsLabel" for="step">Steps <button v-if="recipe.analyzedInstructions.length>0" @click.prevent="removeSteps">Remove all</button></label>
          <div class="steps">
            <details v-for="(step, i) in recipe.analyzedInstructions" :key="step.number">
              <summary>Step {{step.number}}</summary>
              <textarea v-model="step.step" rows="3"></textarea>
              <button type="button" class="remove" @click.prevent="removeStep(i)">Remove</button>

            </details>
          </div>
          <textarea name="step" rows="3" v-model="currentStep" placeholder="Recipe step.."></textarea>
          <button type="button" @click.prevent="addStep">Add step</button>
        </div>
      </div>
      <button type="submit">Upload recipe</button>
    </form>
  </div>
</template>

<script>
import axios from "axios";

export default {
    name: 'AddRecipe',
    data(){
      return{
        error: null,
        errorMsg: null,
        processing: false,
        newIngr: '',
        amount: 0,
        measurement: '',
        stepNumber: 0,
        currentStep: '',
        imageFile: null,
        recipe: {
          title: '',
          image: null,
          servings: 0,
          readyTime: 0,
          summary: '',
          analyzedInstructions: [],
          extendedIngredients: []
        }
      }
    },
    methods: {
      uploadImage(e){
        this.imageFile = e.target.files[0]
        
      },
      addIngr(){
        if(this.newIngr){
          this.recipe.extendedIngredients.push(
            {
              name: this.newIngr,
              amount: this.amount,
              measurement: this.measurement
            }
          )
        }
        this.newIngr = '';
        this.amount = '';
        this.measurement = '';
      },
      removeIngr(i){
        this.recipe.extendedIngredients.splice(i, 1)
      },
      addStep(){
        if(this.currentStep){
          this.stepNumber++;
          this.recipe.analyzedInstructions.push(
            {
              number: this.stepNumber,
              step: this.currentStep
            }
          )

          this.currentStep = ''
        }
      },
      removeStep(i){
        this.recipe.analyzedInstructions.splice(i, 1);
        this.stepNumber = this.stepNumber-i;
      },
      removeSteps(){
        this.stepNumber = 0;
        this.recipe.analyzedInstructions = [];
      },
      uploadRecipe(){
        let imageData = new FormData();
        imageData.append('file',this.imageFile)
        imageData.append("upload_preset","recipes")
        axios.post('https://api.cloudinary.com/v1_1/brit-alliance/image/upload', 
        {
          body: imageData
        })
        .then(res => {
          console.log(res)
        })
        .catch(err => console.log(err))
      }
    },
    computed:{
      ingredients(){
        return this.$store.state.ingredients.ingredients
      }
    }

}
</script>

<style lang="scss" scoped>
.form-wrap{
  form{
    position: unset;
    justify-content: unset;
    align-items: unset;
    padding: 0;

    h2{
      text-align: left;
      margin-bottom: 1rem;
    }

    .inputs{
      .input{
        flex-direction: column;
        justify-content: unset;
        align-items: unset;
        .addedIngr,
        .newIngr{
          display: flex;
          justify-content: space-between;
          input{
            width: 72%;
          }
          button{
            width: 24%;
            color: #80b700;
            background: #fff;
            box-shadow: inset 0 0 0 2px #80b700;

            &.remove{
                color: red;
                background: #fff;
                box-shadow: inset 0 0 0px 2px red;
              }
          }
        }

        .newIngr,
        .addedIngr{
          flex-wrap: wrap;
          summary{
            display: flex;
            justify-content: space-between;
            input{
              width: fit-content;
            }
            button{
              width: fit-content;
            }
          }

          
          >input, button{
            width: 50%;
          }
        }

        .stepsLabel{
          display: flex;
          justify-content: space-between;
          align-items: center;

          button{
            width: fit-content;
            padding: .5rem;
            color: #fff;
            background: red;
          }
        }

        .steps{
          details{
            padding: .5rem 0;
            summary{
              font-size: 1rem;
              font-weight: bold;
            }
              textarea{
                margin: .5rem 0;
              }
              .remove{
                display: block;
                margin: 0 0 0 auto;
                padding: .5rem;
                width: fit-content;
                color: red;
                background: #fff;
                box-shadow: inset 0 0 0px 2px red;
              }
          }
        }

        label{
          font-weight: bold;
          font-size: 1.2rem;
          margin-bottom: .5rem;
        }
        input{
          padding: 1rem;
          font-size: 1rem;
        }

        textarea{
          font-size: 1rem;
          resize: none;
          padding: 1rem;
          width: 100%;
          border: none;
          background: #f2f7f6;
          border-radius: 0.25rem;
          margin-bottom: .5rem;
          &:focus {
            outline: #80b700 solid 2px;
          }
        }

        >button{
          color: #80b700;
          background: #fff;
          box-shadow: inset 0 0 0 2px #80b700;
          width: fit-content;
          margin: 0 0 0 auto;
        }

      }
    }
  }
}
</style>