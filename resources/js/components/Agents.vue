<template>
    <div>
        <h4 class="text-center">All Agents</h4><br/>
        <table class="table table-bordered">
            <thead>
            <tr>
                <th>ID</th>
                <th>UserName</th>
                <th>Created At</th>
                <th>Updated At</th>
                <th>Actions</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="agent in agents" :key="agent.id">
                <td>{{ agent.id }}</td>
                <td>{{ agent.username }}</td>
                <td>{{ agent.created_at }}</td>
                <td>{{ agent.updated_at }}</td>
                <td>
                    <div class="btn-group" role="group">
                        <router-link :to="{name: 'editagent', params: { id: agent.id }}" class="btn btn-primary">Edit
                        </router-link>
                        <button class="btn btn-danger" @click="deleteAgent(agent.id)">Delete</button>
                    </div>
                </td>
            </tr>
            </tbody>
        </table>

        <button type="button" class="btn btn-info" @click="this.$router.push('/agents/add')">Add Agent</button>
    </div>
</template>

<script>
export default {
    data() {
        return {
            agents: [],
        }
    },
    created() {
        this.$axios.get('/sanctum/csrf-cookie').then(response => {
            this.$axios.get('/api/agents')
                .then(response => {
                    this.agents = response.data;
                })
                .catch(function (error) {
                    console.error(error);
                });
        })
    },
    methods: {
        deleteAgent(id) {
            this.$axios.get('/sanctum/csrf-cookie').then(response => {
                this.$axios.delete(`/api/agents/delete/${id}`)
                    .then(response => {
                        let i = this.agents.map(item => item.id).indexOf(id);
                        this.agents.splice(i, 1)
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
