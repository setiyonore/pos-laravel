<template>
    <Head>
        <title>Forgot Password - Aplikasi Kasir</title>
    </Head>
    <div className="col-md-4">
        <div className="fade-in">
            <div className="text-center mb-4">
                <a href="" className="text-dark text-decoration-none">
                    <img src="/images/cash-machine.png" width="70">
                    <h3 className="mt-2 font-weight-bold">APLIKASI KASIR</h3>
                </a>
            </div>
            <div className="card-group">
                <div className="card border-top-purple border-0 shadow-sm rounded-3">
                    <div className="card-body">
                        <div className="text-start">
                            <h5>RESET PASSWORD</h5>
                        </div>
                        <hr>
                        <div v-if="session.status" className="alert alert-success mt-2">
                            {{ session.status }}
                        </div>
                        <form @submit.prevent="submit">
                            <div className="input-group mb-3">
                                <div className="input-group-prepend">
                                    <span className="input-group-text">
                                        <i className="fa fa-envelope"></i>
                                    </span>
                                </div>
                                <input class="form-control" v-model="form.email"
                                       :class="{ 'is-invalid': errors.email }" type="email" placeholder="Email Address">
                            </div>
                            <div v-if="errors.email" className="alert alert-danger">
                                {{ errors.email }}
                            </div>
                            <div className="row">
                                <div className="col-12">
                                    <button className="btn btn-primary shadow-sm rounded-sm px-4 w-100" type="submit">
                                        SEND PASSWORD RESET LINK
                                    </button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
//import layout
import LayoutAuth from '../../Layouts/Auth.vue';

//import reactive
import {reactive} from 'vue';

//inertia adapter
import {Inertia} from '@inertiajs/inertia';

//import Heade and useForm from Inertia
import {
    Head,
    Link,
} from '@inertiajs/inertia-vue3';

export default {

    //layout
    layout: LayoutAuth,

    //register component
    components: {
        Head,
        Link
    },

    props: {
        errors: Object,
        session: Object
    },

    //define composition API
    setup() {

        //define form state
        const form = reactive({
            email: '',
        });

        //submit method
        const submit = () => {
            Inertia.post('/forgot-password', {
                email: form.email
            });
        }

        //return form state and submit method
        return {
            form,
            submit,
        };

    }

}
</script>

<style>

</style>
