<template>
    <div>
        <h4 class="text-center">Add User</h4>
        <div class="row">
            <div class="col-md-6">
                <form @submit.prevent="addUser">
                    <div class="form-group">
                        <label>Name*</label>
                        <input type="text" class="form-control" v-model="user.name" required>
                    </div>
                    <div class="form-group">
                        <label>Email*</label>
                        <input type="email" class="form-control" v-model="user.email" required>
                    </div>
                    <div class="form-group">
                        <label>Phone*</label>
                        <input type="number" class="form-control" v-model="user.phone" required>
                    </div>
                    <div class="form-group">
                        <label>Address</label>
                        <input type="text" class="form-control" v-model="user.address">
                    </div>
                    <div class="form-group">
                        <label>Age*</label>
                        <input id="age" type="date" class="form-control" v-model="user.age" required>
                    </div>
                    <div class="form-group">
                        <label>Password*</label>
                        <input type="password" class="form-control" v-model="user.password" required>
                    </div>
                    <button type="submit" class="btn btn-primary">Add User</button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            user: {},
        }
    },
    methods: {
        addUser() {
            this.$axios.get('/sanctum/csrf-cookie').then(response => {
                this.$axios.post('/api/users/add', this.user)
                    .then(response => {
                        this.$router.push({name: 'users'})
                    })
                    .catch(function (error) {
                        console.error(error);
                    });
            })
        }
    },
    beforeRouteEnter(to, from, next) {
        if (!window.Laravel.isLoggedin) {
            window.location.href = "/";
        }
        next();
    }
}
</script>
