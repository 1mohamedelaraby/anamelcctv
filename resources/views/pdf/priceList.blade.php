<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        html,
        body {
            direction: rtl;
            text-align: right;
            font-family: 'arabic';
            height: 100%;
        }

        table,
        td,
        th {
            border: 1px solid #ccc;
            padding: 8px;
        }

        table {
            width: 100%;
            margin-top: 0.5em;
            border-collapse: collapse;
        }

        th {
            background-color: #ddd;
            border-color: #ccc;
        }
    </style>
</head>

<body>
    <div style="text-align: center">
        <img src="img/logo.png" width="100">
        <h2 style="text-decoration: underline">عرض سعر</h2>
    </div>
    <div>
        <span style="text-decoration: underline;">تاريخ العرض:</span> {{ date('d-m-Y') }}
    </div>
    <div>
        <h2 style="font-weight: bold">السيد/ {{ $fullName }} وفقه الله</h2>
        السلام عليكم ورحمة الله وبركاته أما بعد:
        <br>
        يسر أنامل الخبرة للانظمة الأمنية المتكاملة أن تقدم لكم العرض التالي آملين أن يحوز على رضاكم:
    </div>
    <table style="border-collapse: collapse; width: 100%;">
        <thead>
            <tr>
                <th>المنتج</th>
                <th>الكمية</th>
                <th>السعر</th>
                <th>الاجمالي</th>
            </tr>
        </thead>
        <tbody>
            @foreach ($products as $item)
            <tr>
                <td>{{ $item['product']['name'] }}</td>
                <td>{{ $item['qty'] }}</td>
                <td>{{ $item['product']['price'] }}</td>
                <td>{{ $productsCost = $item['qty'] * $item['product']['price']  }}</td>
            </tr>
            @php($productsTotal += $productsCost)
            @endforeach
            @if ($installmentCost)
            <tr>
                <td>مصاريف التركيب</td>
                <td>{{ $camerasCount }}</td>
                <td>{{ $installmentCost / $camerasCount }}</td>
                <td>{{ $installmentCost }}</td>
            </tr>
            @endif
            <tr>
                <th colspan="3">المجموع</th>
                <th>{{ $total = $productsTotal + $installmentCost }}</th>
            </tr>
            <tr>
                <td colspan="3" style="text-align: center">خصم العرض {{ $discountPercent }}%</td>
                <td>{{ $discount }}</td>
            </tr>
            <tr>
                <th colspan="3">قيمة العرض</th>
                <th>{{ $total - $discount }}</th>
            </tr>
        </tbody>
    </table>

    <div style="margin-top: 0.5em">
        <h3 style="text-decoration: underline">ملاحظات:</h3>
        <ul>
            <li>العرض صالح لمدة شهر من تاريخ التحرير.</li>
            <li>العرض يشمل التوريد و التركيب و لا يشمل التمديد و الأعمال المدنية.</li>
            <li>التنفيذ يكون خلال اسبوعين من تاريخ التعميد مع مراعاة الإجازات الرسمية.</li>
            <li>الضمان يشمل جميع الأجهزة أعلاه لمدة سنتين ولا يشمل سوءالاستخدام.</li>
        </ul>
    </div>
    <div style="">
        <h3 style="text-decoration: underline">الشروط:</h3>
        <ul>
            <li>سداد 70% من قيمة العقد عند التعميد 30% عند التسليم.</li>
        </ul>
    </div>
    <div style="margin-top: 0.5em; text-align: center;">
        نحن على ثقة بتقديم خدمات ترضي تطلعاتكم، ويسعدنا تواصلكم.
    </div>
</body>

</html>