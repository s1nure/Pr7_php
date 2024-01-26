<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PR 7</title>
    <script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
</head>
<body>
    <ul>
        <li><a href="/Pr8/">Students</a></li>
        <li><a href="/Pr8/index.php/subjects">Subjects</a></li>
        <li><a href="/Pr8/index.php/progress">Progress</a></li>
    </ul>
    
    <div id="app">
        <form @submit.prevent="addStudent()">
            <div class="msg" v-if="message">{{message}}</div>
            <input type="text" v-model="newItem.name" placeholder="Name" required /><br>
            <select v-model="newItem.group_id" v-if="groups">
                <option v-for="g in groups" :value="g.id">{{g.name}}</option>
            </select><br>
            <input type="submit" value="Добавить">

        </form>

        <table v-if="students">
            <tr>
            <th>Ім'я</th>
            <th>Група</th>
            <th>Оновити</th>
            <th>Видалити</th>
            </tr>
            <tr v-for="s in students">
            <td><input v-model="s.name"></td>
            <td>
                <select v-model="s.group_id" v-if="groups">
                <option v-for="g in groups" :value="g.id">{{g.name}}</option>
                </select>
            </td>
            <td><button type="submit" @click.prevent="updateStudent(s)" name="update">Оновити</button></td>
            <td><button type="submit" @click.prevent="deleteStudent(s)" name="delete">Видалити</button></td>
            </tr>
        </table>  
    </div>

    <script>
        new Vue({
            el: "#app",
            data: {
                newItem:[],
                message: '',
                students: {},
                groups: {}
            },
            mounted: function() {
                this.getData();
            },
            methods:{
                getData:function(){
                let self = this;
                axios.get("http://localhost:8888/Pr8/index.php/students/getData").then(function(response){
                    if(response.data.students) self.students = response.data.students;
                    if(response.data.groups) self.groups = response.data.groups;
                });
                },
                toFormData:function(obj){
                    const fd = new FormData();
                    for(let i in obj){
                        fd.append(i, obj[i]);
                    }
                    return fd;
                },

                addStudent:function(){
                    if(this.newItem) {
                        let self = this;
                        const formData = this.toFormData(this.newItem);
                        axios.post("http://localhost:8888/Pr8/index.php/students/addStudent", formData)
                            .then((response) => {
                                self.getData();
                                self.newItem = [];
                                self.message= "Студент успешно добавлен";
                                setTimeout(() => {
                                    self.message= "";
                                }, 5000);
                            });
                    }
                },    
                updateStudent:function(student){
                    let self = this;
                    if(student){
                        const formData = this.toFormData(student);
                        formData.append('update', student.id);

                        axios.post("http://localhost:8888/Pr8/index.php/students/actions", formData)
                            .then(() => {
                                this.getData();
                                this.newItem = [];
                                this.message= "Студент успешно изменен";
                                setTimeout(() => {
                                    this.message="";
                                },5000);
                            });
                    }
                },
                deleteStudent:function(student){
                    let self = this;
                    if(student){
                        const formData = this.toFormData(student);
                        formData.append('delete', student.id);

                        axios.post("http://localhost:8888/Pr8/index.php/students/actions", formData)
                            .then(() => {
                                this.getData();
                                this.newItem = [];
                                this.message= "Студент успешно удален";
                                setTimeout(() => {
                                    this.message="";
                                },5000);
                            });
                    }
                }
            }
        });

    </script>
</body>
</html>
