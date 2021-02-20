<template>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-12">
                <h1>Student</h1><br/>
                <b>ID:</b> {{ student.id }}<br/>
                <b>Name:</b> {{ student.firstname }} {{ student.firstname }}<br/>
                <b>Due Date:</b> {{ formatDate(student.birthday) }}<br/>
            </div>
        </div>
        <div class="row justify-content-center">
            <div class="col-md-8">
                <h2>Assignment Grades</h2>
                <table class="table">
                    <thead>
                        <tr>
                            <th scope="col">Assignment</th>
                            <th scope="col">Score</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="grade, idx in grades">
                            <td>{{ grade.assignment.name }}</td>
                            <td>{{ grade.score }}</td>
                        </tr>
                    </tbody>
                </table>
            </div>
            <div class="col-md-4">             
                <form @submit.prevent="save">
                    <h2>Student Grade</h2>
                    <div class="form-group">
                        <label for="studentName">Student: {{ student.firstname }}{{ student.lastname }}</label>
                    </div>
                    <div class="form-group input-group-sm">
                        <label>Assignment:</label><br/>                  
                        <select v-model="grade.assignment_id">
                            <option v-for="assignment in assignments" v-bind:value="assignment.id">{{ assignment.name }}</option>
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
                assignments: [],
                student: {},
                grades: [],
                grade: {}
            }
        },

        mounted() {
            console.log('Component mounted.')
        },
        created(){
            this.loadassignments()
        },
        props: ['studentId'],
        methods: {
            loadassignments() {
                let app = this
                app.grade.student_id = app.$props.studentId

                axios.get(`/api/assignments`).then((data)=>{
                     app.assignments = data.data
                })

                axios.get(`/api/grades/student/${app.$props.studentId}`)
                    .then((data) => {
                        app.grades = data.data
                        axios.get(`/api/student/${app.$props.studentId}`)
                            .then((data) => {
                                app.student = data.data[0]
                            })
                    })
            },
            save() {
                let app = this
                axios.post(`/api/grade`, app.grade)
                    .then((response) => {
                        app.loadassignments()
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