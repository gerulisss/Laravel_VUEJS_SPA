<template>
    <div>
        <h4 class="text-center">All Users</h4><br/>
        <input type="text" name="search" placeholder="search users" v-model="search"/>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Address</th>
                <th>Age</th>
                <th>Created At</th>
                <th>Updated At</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="user in filteredList" :key="user.id">
                <td>{{ user.id }}</td>
                <td>{{ user.name }}</td>
                <td>{{ user.email }}</td>
                <td>{{ user.phone }}</td>
                <td>{{ user.address }}</td>
                <td>{{ user.age }}</td>
                <td>{{ user.created_at }}</td>
                <td>{{ user.updated_at }}</td>
                <td>
                    <div class="btn-group" role="group">
                        <router-link :to="{name: 'edituser', params: { id: user.id }}" class="btn btn-primary">Edit
                        </router-link>
                        <button class="btn btn-danger" @click="deleteUser(user.id)">Delete</button>
                    </div>
                </td>
            </tr>
            </tbody>
        </table>

        <button type="button" class="btn btn-info" @click="this.$router.push('/users/add')">Create User</button>
    </div>
</template>

<script>
export default {
    data() {
        return {
            users: [],
            search: ''
        }
    },
    created() {
        this.$axios.get('/sanctum/csrf-cookie').then(response => {
            this.$axios.get('/api/users')
                .then(response => {
                    this.users = response.data;
                })
                .catch(function (error) {
                    console.error(error);
                });
        })
    },
    methods: {
        deleteUser(id) {
            this.$axios.get('/sanctum/csrf-cookie').then(response => {
                this.$axios.delete(`/api/users/delete/${id}`)
                    .then(response => {
                        let i = this.users.map(item => item.id).indexOf(id);
                        this.users.splice(i, 1)
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
    },
    computed: {
        filteredList(){
            return this.users.filter(user => {
                return user.name.toLowerCase().indexOf(this.search.toLowerCase()) !== -1 ||
                    user.email.toLowerCase().indexOf(this.search.toLowerCase()) !== -1 ||
                    user.phone.toLowerCase().indexOf(this.search.toLowerCase()) !== -1 ||
                    user.created_at.toLowerCase().indexOf(this.search.toLowerCase()) !== -1 ||
                    user.updated_at.toLowerCase().indexOf(this.search.toLowerCase()) !== -1
            })
        }
    }
}
</script>
