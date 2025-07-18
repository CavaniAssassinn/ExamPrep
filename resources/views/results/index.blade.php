<h1>Your Results</h1>
<table>
    <tr>
        <th>Subject</th>
        <th>Marks</th>
    </tr>
    @foreach ($results as $result)
        <tr>
            <td>{{ $result->subject }}</td>
            <td>{{ $result->marks }}%</td>
        </tr>
    @endforeach 
</table>
