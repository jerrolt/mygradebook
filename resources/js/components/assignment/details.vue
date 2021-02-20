<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <h1>Assignment</h1><br/>
                <b>ID:</b> {{ assignment.id }}<br/>
                <b>Name:</b> {{ assignment.name }}<br/>
                <b>Due Date:</b> {{ formatDate(assignment.date_due) }}<br/>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h2>Student Grades</h2>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Student</th>
                            <th scope="col">Score</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="grade, idx in grades">
                            <td>{{ grade.student.firstname }} {{grade.student.lastname}}</td>
                            <td>{{ grade.score }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-md-4">             
                <form @submit.prevent="save">
                    <h2>Add New Grade</h2>
                    <div class="form-group">
                        <label for="assignmentName">Assignment: {{ assignment.name }}</label>
                    </div>
                    <div class="form-group input-group-sm">
                        <label>Student:</label><br/>                  
                        <select v-model="grade.student_id">
                            <option v-for="student in students" v-bind:value="student.id">{{ student.firstname }} {{student.lastname}}</option>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="assignmentDueDate">Score</label>
                        <input type="text" class="form-control" placeholder="0 - 100" v-model="grade.score">
                    </div>
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
                students: [],
                assignment: {},
                grade: {},
                grades: []
            }
        },

        mounted() {
            console.log('Component mounted.')
        },
        created(){
            this.loadstudents()
        },
        props: ['assignmentId'],
        methods: {
            
            loadstudents() {
                let app = this
                app.grade.assignment_id = app.$props.assignmentId

                axios.get(`/api/students`).then((data)=>{
                     app.students = data.data
                })

                axios.get(`/api/grades/assignment/${app.$props.assignmentId}`)
                    .then((data) => {
                        app.grades = data.data
                        axios.get(`/api/assignment/${app.$props.assignmentId}`)
                            .then((data) => {
                                app.assignment = data.data[0]
                            })
                    })
            },

            save() {
                let app = this
                axios.post(`/api/grade`, app.grade)
                    .then((response) => {
                        app.loadstudents()
                    }, (error) => {
                        console.log(error)                           
                    })
            },

            formatDate(ddate){
                if(ddate !== undefined)
                {
                    let [y, m, d] = ddate.split("-")               
                    return `${m}/${d}/${y}`
                }
                return ''
            }
        }
    }
</script>