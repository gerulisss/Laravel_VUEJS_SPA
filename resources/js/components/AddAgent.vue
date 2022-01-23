<template>
    <div>
        <h4 class="text-center">Add Agent</h4>
        <div class="row">
            <div class="col-md-6">
                <form @submit.prevent="addAgent">
                    <div class="form-group">
                        <label>UserName*</label>
                        <input type="text" class="form-control" v-model="agent.username">
                    </div>
                    <button type="submit" class="btn btn-primary">Add Agent</button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
export default {
    data() {
        return {
            agent: {},
            errors:[],
        }
    },
    methods: {
        addAgent() {
            this.$axios.get('/sanctum/csrf-cookie').then(response => {
                this.$axios.post('/api/agents/add', this.agent)
                    .then(response => {
                        this.$router.push({name: 'agents'})
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
