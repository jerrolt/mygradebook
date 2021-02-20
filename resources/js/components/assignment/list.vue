<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h1>Assignments</h1>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col"></th>
                            <th scope="col">
                                <span v-on:click="sortBy('name','asc')" class="glyphicon glyphicon-triangle-top">Name</span>
                            </th>
                            <th scope="col">
                                <span v-on:click="sortBy('duedate','desc')" class="glyphicon glyphicon-triangle-bottom">Due Date</span>
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="assignment, idx in assignments">
                            <th scope="row">  
                                <a v-on:click="getUrl(assignment.id)" class="btn btn-outline-primary btn-sm">details</a>                    
                            </th>
                            <td>{{ assignment.name }}</td>
                            <td>{{ formatDate(assignment.date_due)  }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-md-4">             
                <form @submit.prevent="save">
                    <h2>Assignment Details</h2>
                    <div class="form-group">
                        <label for="assignmentName">Assignment Name</label>
                        <input type="text" class="form-control" id="assignmentName" placeholder="Assignment Name" v-model="assignment.name">
                    </div>
                    <div class="form-group">
                        <label for="assignmentDueDate">Assignment Due Date</label>
                        <input type="date" class="form-control" id="assignmentDueDate" placeholder="YYYY-MM-DD" v-model="assignment.date_due">
                    </div>
                    
                    <button type="reset" class="btn btn-primary btn-sm" v-on:click="resetForm()">Reset</button>
                    <button type="submit" class="btn btn-primary btn-sm" id="assignmentSubmitBtn">Create</button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                assignments: [],
                assignment: {}
            }
        },

        mounted() {
            console.log('Component mounted.')
        },

        created() {
            this.refresh()
        },

        methods: {
            refresh() {
                let app = this
                axios.get('/api/assignments')
                    .then((data) => {
                        app.assignments = data.data
                    })
            },
            resetForm(){
                this.assignment = {}
            },
            save() {
                let app = this
                axios.post(`/api/assignment`, app.assignment)
                    .then((response) => {
                        app.refresh()
                        app.resetForm()
                    }, (error) => {
                        console.log(error)                           
                    })
            },

            formatDate(ddate){
                let [y, m, d] = ddate.split("-")               
                return `${m}/${d}/${y}`
            },

            getUrl(id) {
                window.location = `/assignment/${id}`
            }
        }
    }
</script>
