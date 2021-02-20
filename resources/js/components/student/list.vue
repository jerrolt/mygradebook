<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h1>Students</h1>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col"></th>
                            <th scope="col">
                                <i v-on:click="sortBy('firstname','asc')" class="icon-arrow-up"></i>First Name
                            </th>
                            <th scope="col">
                                <i v-on:click="sortBy('lastname','desc')" class="icon-arrow-down"></i>Last Name
                            </th>
                            <th scope="col">
                                <i class="icon-arrow-down" v-on:click="sortBy('birthday','desc')"></i>Birthday
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="student, idx in students">
                            <th scope="row">
                                <a v-on:click="getUrl(student.id)"  class="btn btn-outline-primary btn-sm" href="#">details</a>                     
                            </th>
                            <td>{{ student.firstname }}</td>
                            <td>{{ student.lastname }}</td>
                            <td>{{ formatDate(student.birthday) }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-md-4">             
                <form @submit.prevent="save">
                    <h2>Create Student</h2>
                    <div class="form-group">
                        <label for="studentFirstname">First Name</label>
                        <input type="text" class="form-control" id="studentFirstname" placeholder="Student First Name" v-model="student.firstname">
                    </div>
                    <div class="form-group">
                        <label for="studentLastname">Last Name</label>
                        <input type="text" class="form-control" id="studentLastname" placeholder="Student Last Name" v-model="student.lastname">
                    </div>
                    <div class="form-group">
                        <label for="studentBirthday">Birthday</label>
                        <input type="date" class="form-control" id="studentBirthday" placeholder="YYYY-MM-DD" v-model="student.birthday">
                    </div>
                    <button type="reset" class="btn btn-primary btn-sm" v-on:click="resetForm()">Reset</button>
                    <button type="submit" class="btn btn-primary btn-sm">Create</button>
                </form>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data() {
            return {
                students: [],
                student: {}
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
                axios.get('/api/students')
                    .then((data) => {
                        app.students = data.data
                    })
            },
            
            resetForm(){
                this.student = {}           
            },

            save() {
                let app = this
                axios.post(`/api/student`, app.student)
                        .then((response) => {
                            app.refresh()
                            app.resetForm()
                        }, (error) => {
                            this.resetForm()
                        })
            },

            formatDate(bday){
                let [y, m, d] = bday.split("-")               
                return `${m}/${d}/${y}`
            },

            getUrl(id) {
                window.location = `/student/${id}`
            }
        }
    }
</script>
