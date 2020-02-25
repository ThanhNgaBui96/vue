<style lang="scss">
  #login-form {
    input {
      min-width:300px;
    }
    .required {
      color:red;
    }
    background: #ffffff;
    width: 450px;
    padding: 50px;
    .card {
      height: 300px;
      .card-body {
        padding: 45px 50px 50px 50px;
        .title {
          margin-bottom: 27px;
          font-size: 20px;
        }
      }
    }
  }
</style>
<template>
  <div class="row full-height">
    <div id="login-form" class="m-auto">
      <div>
        <ValidationObserver v-slot="{ handleSubmit }">
          <form @submit.prevent="handleSubmit(login)">
          <!-- Email -->
            <div class="title font-weight-bold mb-2">login</div>
            <ValidationProvider name="email" rules="required|email|max:255" v-slot="{ errors, valid }">
              <div class="form-group row">
                <div class="col-md-12">
                  <b-input-group>
                    <b-input-group-prepend>
                      <span class="input-group-text"><i class="fas fa-envelope"></i></span>
                    </b-input-group-prepend>
                    <b-form-input type="text" name="email" v-model="form.email" />
                    <p><span class="required">{{ errors[0] }}</span></p>
                  </b-input-group>
                </div>
              </div>
            </ValidationProvider>
            <!-- Password -->
            <ValidationProvider name="password" rules="required|min:6" v-slot="{ errors, valid }">
              <div class="form-group row">
                <div class="col-md-12">
                  <b-input-group>
                    <b-input-group-prepend>
                      <span class="input-group-text"><i class="fas fa-lock"></i></span>
                    </b-input-group-prepend>
                    <b-form-input type="password" name="password" v-model="form.password" />
                    <p><span class="required">{{ errors[0] }}</span></p>
                  </b-input-group>
                </div>
              </div>
            </ValidationProvider>
            <div class="d-flex">
              <b-button type="submit" variant="primary">Login</b-button>
            </div>
          </form>
        </ValidationObserver>
      </div>
    </div>
  </div>
</template>

<script>
import { mapState } from "vuex";
import {ValidationObserver, ValidationProvider} from "vee-validate";
import { required } from 'vee-validate/dist/rules';

export default {
  name: 'app.login',
  metaInfo: () => {
    return {
      title: 'Login'
    }
  },
  components: {
    ValidationObserver,
    ValidationProvider,
  },
  computed: {
    ...mapState("auth", {
      login_res: state => state.login_res,
      token_user: state => state.token_user,
    })
  },
  data () {
    return {
      form: {
        email: '',
        password: ''
      }
    }
  }, 
  methods: {
    async login () {
      this.$root.$loading.start();
      await this.$store.dispatch("auth/login", this.form);
      await this.$store.dispatch("auth/fetchUser");
      this.$root.$loading.finish();
      this.$router.push({ name: "app.index" });
    }
  }
}
</script>