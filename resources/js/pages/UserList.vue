<template>
    <div class="container">
        <table class="table table-bordered border-primary">
        <thead>
          <tr>
            <th>STT</th>
            <th>Tên nguồi dùng</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Phòng ban</th>
            <th>Phân quyền</th>
          </tr>
        </thead>
        <tbody>
          <!-- <tr v-for="(ticket, index) in ticket.list" :key="ticket.id">
            <td>{{ index + 1 }}</td>
            <td>{{ ticket.title }}</td>
            <td>{{ ticket.user?.name || "" }}</td>
            <td>{{ ticket.category?.categories_name || "" }}</td>
            <td>{{ ticket.department?.department_name || "" }}</td>
            <td>
              <div v-if="ticket.assigned_to">
                {{ ticket.assigned_to?.name || "null" }}
              </div>
              <div v-else>
                <select class="form-select" @change="user.assignTo($event, ticket.id)">
                  <option disabled selected>Assign to</option>
                  <option v-for="(user) in user.listUser" :key="user.id" :value="user.id">
                    {{ user.name }}
                  </option>
                </select>
              </div>
            </td>
            <td>{{ priority_level[ticket.priority]}}</td>
            <td>{{ ticket.updated_at }}</td>
            <td>{{ statusTexts[ticket.status] }}</td>
            <td></td>
          </tr> -->
        </tbody>
      </table>
    </div>
</template>

<style>
    td,th {
        text-align: center;
    }
</style>