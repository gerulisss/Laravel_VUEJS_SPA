<template>
    <div>
        <h4 class="text-center">Edit Agent</h4>
        <div class="row">
            <div class="col-md-6">
                <form @submit.prevent="updateAgent">
                    <div class="form-group">
                        <label>UserName</label>
                        <input type="text" class="form-control" v-model="agent.username">
                    </div>
                    <button type="submit" class="btn btn-primary">Update Agent</button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            agent: {}
        }
    },
    created() {
        this.$axios.get('/sanctum/csrf-cookie').then(response => {
            this.$axios.get(`/api/agents/edit/${this.$route.params.id}`)
                .then(response => {
                    this.agent = response.data;
                })
                .catch(function (error) {
                    console.error(error);
                });
        })
    },
    methods: {
        updateAgent() {
            this.$axios.get('/sanctum/csrf-cookie').then(response => {
                this.$axios.post(`/api/agents/update/${this.$route.params.id}`, this.agent)
                    .then(response => {
                        this.$router.push({name: 'agents'});
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
