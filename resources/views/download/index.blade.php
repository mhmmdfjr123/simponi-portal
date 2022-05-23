@extends('layouts.front')

@section('content')
    <div class="content-header with-bg bg-wisma46-mini">
        <h1>Download</h1>
        <hr class="title">
    </div>

    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="content-detail">
                    <div class="row">
                        <div class="col-sm-4" id="sidebar">
                            <ul class="nav nav-tabs nav-stacked" id="faq-navigation">
                                @if($categoryAlias == '')
                                    <li {!! $categoryAlias == '' ? 'class="active"' : '' !!}><a href="{{ route('download-list') }}" style="border-top-right-radius: 5px;border-top-left-radius: 5px;">SEMUA KATEGORI</a></li>
                                @else
                                    <li {!! $categoryAlias == '' ? 'class="active"' : '' !!}><a href="{{ route('download-list') }}">SEMUA KATEGORI</a></li>
                                @endif
                                
                                @foreach($categories as $category)
                                    @if($categories[$countData - 1]['name'] == $category->name)
                                        <li {!! $categoryAlias == $category->alias ? 'class="active"' : '' !!}><a href="{{ route('download-category', [$category->alias]) }}" style="border-bottom-right-radius: 5px;border-bottom-left-radius: 5px;">{{ $category->name }}</a></li>
                                    @else
                                        <li {!! $categoryAlias == $category->alias ? 'class="active"' : '' !!}><a href="{{ route('download-category', [$category->alias]) }}">{{ $category->name }}</a></li>
                                    @endif
                                @endforeach
                            </ul>
                        </div>
                        <div class="col-sm-8">
                            <!-- Search -->
                            <div class="row" style="display: flex;align-items: center;">
                                <div class="col-sm-6">
                                    <div class="input-group">
                                        <form action="" method="GET">
                                            <!-- <span class="input-group-addon"><i class="bi bi-search"></i></span> -->
                                            <!-- <i class="bi bi-search"> -->
                                            <input class="searchBox" type="text" name="keyword" placeholder="Cari dokumen anda disini" value="{{ request('keyword') }}">
                                        </form>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <!-- Dropdown Urutkan -->
                                    <div class="dropdown">
                                        <button class="dropbtn">Urutkan</button>
                                        <div class="dropdown-content">
                                            <a href="{!! $categoryAlias == '' ? route('download-list') : route('download-category', [$categoryAlias]) !!}?urutkan=atoz">A - Z</a>
                                            <a href="{!! $categoryAlias == '' ? route('download-list') : route('download-category', [$categoryAlias]) !!}?urutkan=ztoa">Z - A</a>
<!-- 
                                            <a href="{{ route('download-category', [$categoryAlias]) }}?urutkan=atoz">A - Z</a>
                                            <a href="{{ route('download-category', [$categoryAlias]) }}?urutkan=ztoa">Z - A</a> -->
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!-- End Search -->
                            <!-- Download List -->
                            <ul class="download-list">
                                @if($countFiles != 0)
                                @foreach($files as $file)
                                    <li class="borderDownload">
                                        <div style="display: flex; height: 100%; align-items: center;">
                                            <div class="file-type hidden-xs">
                                                <div style="margin-top:12px;" class="pdfSVG">
                                                    @if($file->file_ext == 'pdf')
                                                    <svg width="92" height="92" viewBox="0 0 92 92" fill="none" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink">
                                                        <rect x="0.188477" y="0.188477" width="91.6235" height="91.6235" fill="url(#pattern0)"/>
                                                        <defs>
                                                            <pattern id="pattern0" patternContentUnits="objectBoundingBox" width="1" height="1">
                                                                <use xlink:href="#image0_427_706" transform="scale(0.00195312)"/>
                                                            </pattern>
                                                        <image id="image0_427_706" width="512" height="512" xlink:href="data:image/png;base64,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yM1Dbh4yJHYu+CQKAAAAgNVUumPPR3o+sssuPTuf8dAZD5133rSLBp89+Oz114+dCz5KAQAAANBKSn/ea69ee+2+e/fdvvbXr/31u9/926ghNw+5ecCA2LkgBAUAAABAqyuv739q/1MPPLD7oyfOOXHOt741derQ14e+vt56sXORbwoAAACANaSiaYMNNtjgy1/u3uu4B4574L//+2+nDB4/eHyfPrFzkU8KAAAAgDWsavGgFwe9eNhhja9+Nflq8vWvT31iyM1Dbl533di5yBcFAAAAwJpWF8aGsUnS6Ucbj9h4xDHHrHPpYbsftvvxxz/ac9hXh321Z8/Y8cgHBQAAAMDa0lIEnLrZdpttd8opvW78UvhSOP74vz008PCBh/foETseHZsCAAAAYG3rE84OZxcK1XO/sOcX9jz11PovfunaL137la88dsCG52x4TrdusePRMSkAAAAAYtk6KUvKiotrf7zViK1GnHHGOrN232T3TQ4//O+nbvyDjX/Q2Bg7Hh2LAgAAACC2Q5LJyeTS0rqx226x7RZnnllz9/ip46d++cuP9xh07KBj6+tjx6NjUAAAAAC0FccX/l74e1lZ5/W3f2z7x846q37XnS/f+fKDD36055Cbh9zcpUvseLRvCgAAAIC25rrC9YXrKyvrb96lsEvhe99rPH7cDeNu2G+/aemwdFhaVxc7Hu1TcewAAAAA/B9eLbq36N6ami61eyzfY/n556dnL3t32bsrVkx9Yn6/+f1uvnmzL7wy45UZTU2xY9I+2AEAAADQxiVNxcXFxbW19evvc/A+B597btVjY14b89qeez40e+DhAw+vro6dj/ZBAQAAANBOJDuXnF5yeteu6xQdsPiAxT/4QUOfzU7e7OQ99vhzOuTmITd36hQ7H22bAgAAAKCdSb5U+nDpww0NjZsccv0h119wQY/dNrxpw5vGj586dcSIESMqK2Pno21SAAAAALRTyV1lu5bt2qNHw4/+67z/Om/SpPLv9Hyh5ws77TRz8qiZo2ZWVMTOR9uiAAAAAGjnCo0V/6r4V58+PfY96qmjnvrBD+bt1fB6w+s77PDntE/aJy0vj52PtkEBAAAA0EEU9q6cWTmzf//u232l5Csl55/ftWyDTTfYdNy4u14ccMmAS8rKYucjLo8BBABYw6qqNt54441DCCFN0zR2GiAXXgohhEGD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L587d+7cEF555Wtf+9rXQpg587zzzjsvhBCam5ubY6ejo0vTFStWrAjhvfd+85vf/CaE557Lzg547bWzzjrrrBCWL58zZ86c2CkBoG1TAACwSmbNuuGGG24I4eWXTzrppJNWXrGFtaGlEHj33VtuueWWEJ59Nnve+bvv3nrrrbeGoJgCgP9NAQDAapk797777rsvhJdfPv74448Pobl5yZIlS2KnIm9aDg187bUzzzzzzBCef/7ggw8+2NkBAPBRCgAAWkXLUwNeeeXkk08+OYQ0Xb58+fLYqcirDz74+9///vcQnn9+v/32229lUQUAeaYAAKBVNTX95S9/+UsIb7wxadKkSbHTkHfLlzc1NTWtfMxly1MFFFQA5JECAIA1ouU57++99+tf//rXsdNApuWpAtOnH3XUUUeFsGLFggULFsROBQBrhwIAgDXq9dfPOeecc0JYuvStt956K3YayMyf/9hjjz0WwosvHnbYYYeFsGzZu++++27sVACwZikAAFijmpsXLly4MISZM88999xzY6eBj1u48LnnnnsuhBdeOOiggw4KYenSN998883YqQBgzVAAALBWzJ37pz/96U8hNDU98MADD8ROAx/X8rSAl146+uijjw5hxYr58+fPj50KAFqXAgCAteqtty6//PLLY6eAT7Zo0UsvvfTSysdapumyZcuWxU4FAK1DAQDAWvXBB//4xz/+EcL8+U888cQTsdPAJ2t5f7722ne/+93vxk4DAK1DAQBAFLNnZ08JgLbsvffuuOOOO0J4770777zzzthpAGD1KAAAiKLlLAD3WtMezJx53nnnnRfC0qXvvPPOO7HTAMCqKY4dAKCtKCqqrq6uDqG4uLa2tnbN//vSdMWKFStWPoc8bwvh5uYlS5YsCaGp6f77778/hC5ddtttt91ip2o7ysp69erVa/X/Oc3NixcvXhzC8uVNTU1N7mlfVS1/P19//Xvf+973Qhgw4LLLLrssdqqOo1AoLy8vD6GkpGvXrl1jp+k4CoWKioqK2CmAtkQBAPChrl0nTJgwIYRevU499dRT1/6/v+VxeQsX/vOf//xnCAsWTJs2bdrKLciLF7/66quvxv6v1Pqamh588MEHFQD/bsiQbMt5y8KotaxYMW/evHkhLF06a9asWSEsXjxjxowZISxZko0tZzS0vP+WL58zZ86c2P812o6W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WuxUradLl1122WWX2CkA4JMpAACANW7RounTp08P4fnnDzzwwANDWLjw+eeffz52qtaTJEVFRUUhdO5s6z8AbZfHAAIArS5NV6xYsWLl4X7/+tdFF110UQjNzQsXLlwYO13rq63dZptttgmhpKRr165dY6cBgE+mAAAAWs2CBU899dRTIcycee65554bwsKFzz777LOxU61JSZIkIXTvfvTRRx8dOwsAfDoFAACwyloW+G++efnll18eQlPT/ffff3/sVGtPXd222267bQiVlYMHDx4cOw0AfDoFAADwH7Vs3Z87909/+tOfQpg9+8Ybb7xx5RX//CkUCoUQevTInmIAAO2BAgAACCE0Nzc3h7Bo0UsvvfRSCAsWPPnkk0+GMH/+X//617+G0NT04IMPPhhCc/PixYsXx84aX+fOO+64444hVFRssMEGG8ROAwCfjQIAANqguXPvueeee0JIktLS0tLP/79vWain6dKlS5eGsHz5nDlz5oSwbFnLOHv27NkhLFkyY8aMGSEsXpyNzc1LlixZEvtP33YVFdXU1NSE0Lv3N77xjW/ETgMAn48CAADaoBkzTj/99NNjp+Df9e59xhlnnBFCSUlDQ0ND7DQA8PkUYgcAAGjramvHjBkzJoT6+t1333332GkAYNUoAAAA/g/FxV26dOkSQp8+Z5555pmx0wDA6lEAAAD8m0KhrKysLIT11rv00ksvDaGkpFu3bt1ipwKA1aMAAAD4H0mSJCH06XP22WefHUKnTptssskmsTMBQOtQAAAAfKhnz5NPPvnkELp02WWXXXaJnQYAWpenAAAAOZZd8e/e/eijjz46hHXWmThx4sTYmQBgzVAAAAC5kyRFRUVFIay7bna4X9eu++yzzz6xUwHAmqUAAAByo6ioqqqqKoT+/S+66KKLQqipGT169OjYqQBg7VAAAAAdXmXl0KFDh4bQr9+kSZMmhVBe3rdv376xUwHA2qUAAAA6oOze/sbGgw466KAQevX62te+9rUQkqSkpKQkdjYAiEMBAAB0GGVlvXr16rXy3n5b/AFgJQUAANBuFQrl5eXlIXTrdvjhhx8ewjrrHHHEEUeEUCiUlZWVxU4HAG2LAgAAaEcKhUIhhC5ddtppp51C6NnzlFNOOSWE0tLu3bt3j50NANo2BQAA0GYlSXFxcXEIXbqMHz9+fAjrrHPkkUceGUJ5ef/+/fvHTgcA7YsCAABoM4qL6+rq6kKor99jjz32CKGx8dBDDz00hNLSddZZZ53Y6QCgfVMAAAARZFv5a2o233zzzUPo0mW33XbbLYTOnXfccccdV97bDwC0HgUAALDGFBV16tSpUwjV1aNGjRoVQm3tVltttVUItbVjxowZE0JJSUNDQ0PslACQDwoAAGCVlZZ269atWwiVlUOGDBkSQkXF4MGDB4dQXT1y5MiRIXTqNHz48OEhJElRUVFR7LQAkG8KAADIkaKi6urq6hCSJNuCv3JeUlJSEkJJSWNjY+PKe+5bTtdveb2srHfv3r1DqKwcNGjQoBCKi7t06dIl9p8KAPgsktgBiCttTpvT5q9/PSQhCcmkSbHzAAAAa0Aa0pCedlpSSApJ4Qc/iB2HOAqxAwAAAABrngIAAAAAckABAAAAADmgAAAAAIAcUAAAAABADigAAAAAIAcUAAAAAJADCgAAAADIAQUAAAAA5IACAAAAAHJAAQAAAAA5oAAAAACAHFAAAAAAQA4oAAAAACAHFAAAAACQAwoAAAAAyAEFAAAAAOSAAgAAAAByQAEAAAAAOaAAAAAAgBxQAAAAAEAOKAAAAAAgBxQAAAAAkAMKAAAAAMgBBQAAAADkgAIAAAAAckABAAAAADmgAAAAAIAcUAAAAABADigAAAAAIAcUAAAAAJADCgAAAADIAQUAAAAA5IACAAAAAHJAAQAAAAA5oAAAAACAHFAAAAAAQA4oAAAAACAHFAAAAACQAwoAAAAAyAEFAAAAAOSAAgAAAAByQAEAAAAAOaAAAAAAgBxQAAAAAEAOKAAAAAAgBxQAAAAAkAMKAAAAAMgBBQAAAADkgAIAAAAAckABAAAAADmgAAAAAIAcUAAAAABADigAAAAAIAcUAAAAAJADCgAAAADIAQUAAAAA5IACAAAAAHJAAQAAAAA5oAAAAACAHFAAAAAAQA4oAAAAACAHFAB5l4QkJM3NsWMAAABrkO/9BAUAaUhDumxZ7BgAAMAalIY0pEuWxI5BXAqAvEtCEpKlS2PHAAAA1iDf+wkKAEIIIWgCAQCg4/O9P+8UAIQQmppiJwAAANa0uXNjJyAuBUDepSEN6bvvxo4BAACsab73550CIO+SkITkvfdixwAAANY03/vzTgFACOHtt2MnAAAA1rR33omdgLiS2AFoG9I0TdN03rxsVl0dOw8AANBampqSJEmSpK4udhLisgOAj3j11dgJAACAVpSGNKSvvBI7Bm2DAoCPePnl2AkAAIDWNmNG7AS0DQoAPuKZZ2InAAAAWlESkpD84x+xY9A2KAD4CB8MAADQ8fieT0YBwEc8/XTsBAAAQCtKQxpSBQAZTwEghNDyFIDkw/dDy/NBO3eOnQsAAFhV77+fjQ0N2VMAmptjJyIuOwAIIYSQfSCkaTb7619j5wEAAFbXww9b+PNRCgA+Lg1pSB9+OHYMAABgdflez8cpAPi4JCQh+fOfY8cAAABWQxrSkPpez8c5A4CPyc4CKCrKZrNmZWOXLrFzAQAAn0Ea0pC++252Ya9bN7cA8FF2APAx2QfEihXZB8d998XOAwAAfA5JSEIyZYqFP59EAcCn+M1vYicAAAA+r9/9LnYC2ia3APCJ0ua0OW2urs4axHfeyV6tqIidCwAA+L8sXJjt5O3WLSkkhaSwYEHsRLQtdgDwibIPjPnzs9mUKbHzAAAA/8nvfmfhz6dRAPDp0pCG9Je/jB0DAAD4T268MXYC2ja3APCpslsBSkuzWwFmzsxebWyMnQsAAGjxzjvZhbvevbMdAMuWxU5E22QHAJ8q+wBZujT7QPn5z2PnAQAA/t3111v481nYAcBnku0EWH/9bCfA889nrxYUSAAAEE1zc3ahbuDArAB46aXYiWjbLOD4TLIPlOnTs9lvfxs7DwAAcMcdFv58HgoAPp80pCGdPDl2DAAAwPdyPh8FAJ9L1jA++GA2e+SR2HkAACB/HnggSZIkSR59NHYS2hcFAKvhO9+JnQAAAPLnzDNjJ6B9UgCwSrLG8b77slsC7r8/dh4AAOjQ0pCG9N57s+/hvn+zajwFgNWSpmmapqNGZbOWWwIS7ysAAGg1Laf9b755dkvu1KmxE9E+2QHAaskayMcey2a/+EXsPAAA0PH89KcW/rQGV2ppFWlz2pw29+qVzZ5/PiQhCUlVVexcAADQfs2fn40DB2YX3t56K3Yi2jc7AGgVWSP5xhvZ7KyzYucBAIB2LQ1pSL/1LQt/WpMdALSq7EyAoqLsA+uxx7KdAJttFjsXAAC0H088kY1bbJEVACtWxE5Ex6AAYI3IbgkYNiwrAB5/PHu1tDR2LgAAaLuWLs0upH3hC9kO26efjp2IjsUtAKwR2QfW3/+ezb7zndh5AACgTUtDGtJvftPCnzXJDgDWqOyWgEIh+0C7555sR8C4cbFzAQBA2/GXv2TjuHHZlv/m5tiJ6JgUAKwV//OUgCQkIXnyyezVxsbYuQAAIJ533snG4cOzhf+bb8ZORMfmFgDWio8/JWDvvbNx2bLYuQAAYO1bvjwb99/fwp+1SQHAWpV9wD38cDY7/fTYeQAAYO077bTse3HL1n9YO9wCQFTZGQGXXZbNjjkmdh4AAFhzrr02W/gfcUTsJOSTAoCosgKgqCib/frX2bjrrrFzAQBA65kyJTsUe9dds1tjW24BgLVLAUCbkB0SWF2dHRJ4773ZqyNHxs4FAACr7oknsoX/tttmC//582MnIt8UALQp2Y6Aurrsg/JPf8oKgU03jZ0LAAA+u2eeycZttsm2/L/3XuxEEIJDAGljsg/IuXOz2c47Z+Nzz8XOBQAAnyoNaUiffz6bbL+9hT9tkQKANinbItXyXNQtt8zGxx+PnQsAAD4mDWlIp03LJltvnS383347diz4JAoA2rTsA3TOnGy2447Z2PIYQQAAiOmRR7JbVseNyy5gzZ4dOxF8GgUA7cL/3Brw4SEq2as33hg7FwAAeXTHHdnYstW/5RZWaNsUALQrWbO6ZEk2O/jgbJw0KXYuAAA6uDSkIf3hD7PJvvtmC/+FC2PHgs/DUwDoELKnBxxwQPbBfM012VasqqrYuQAAaM8WL87GY47JFvw/+UnsRLA6FAB0KGlz2pw2b7RRVgDcdlv26vrrx84FAEB7Mn16dmFp332zHahPPx07EbQGtwDQoWQf0P/4RzYbNiwbL7kkdi4AANqDn/88W/gPH27hT0dkBwC5kO0M2HffbGfA5ZdnrzY0xM4FAEBM772Xjccem23xv+mm2IlgTbIDgFzIGtxbb81mAwdm41VXZWOaxs4HAMBakoY0pLfcko1Dhlj4kyd2AJBr2c6AHXbIZhdfnO0QGDQodi4AAFrTiy9m44knZgv+P/4xdiKIwQ4Aci3bGXD33dls442z8aSTsnHOnNj5AABYFU1N2fi1r2VX+jfayMIf7ACAT5TtDKiuznYEHHNM9uoZZ2RjbW3sfAAAfCgNaUg/+CD73nbttdn83HOzCz3vvBM7HrQlCgD4DLJCoGvX7AfLqadmrx51VDZ27hw7HwBAvsybly30W850+uEPLfjhP1MAwCrICoFOnbJCYOLE7AfQ8cdn8/XWi50PAKBjee217PvWj3+cza+6Klvwz5sXOxm0JwoAaAVpmqZpmnz492ncuGycODEb99orG8vLY+cEAGjbli7Nxt/8JlvwX3NNdoHlnnuye/ibm2MnhPZMAQBrULZToOXMgD32yH6ATZiQzVuePlBaGjsnAMDatWJFNj72WDa2PJbvxhuzK/uzZsVOCB2RAgAi+J9iIAlJSLbbLvuBt9NO2bylGFh33dg5AQBWz1tvZeOUKdnYcgp/yxX999+PnRDyRAEAbVBWEPTpkxUCW26ZvTp6dFYUDB+evT50aPZ6dXXsvABA3ixcmI3PPpuN06Zl31Mefjj7nvLww9kC/+WXYycFVlIAQDv08TMH+vXLxoED/2eehjSkfftmP4B79crm3bpl8/r67Pe1jFVV2djyz6uri/3nAwBaW8theS1b7xctysb33su+J7z3XvY9YdasbP7GG9n81Vez+YwZ2e9/4YXs9Zdfdk8+tD//H14Ly9wBfkL5AAAAJXRFWHRkYXRlOmNyZWF0ZQAyMDIxLTExLTIyVDAzOjA1OjU2KzAwOjAwin6QXAAAACV0RVh0ZGF0ZTptb2RpZnkAMjAyMS0xMS0yMlQwMzowNTo1NiswMDowMPsjKOAAAAAASUVORK5CYII="/>
                                                        </defs>
                                                    </svg>
                                                    @elseif($file->file_ext == 'doc' || $file->file_ext == 'docx')
                                                        <i class="fa fa-file-word-o"></i>
                                                    @elseif($file->file_ext == 'ppt' || $file->file_ext == 'pptx')
                                                        <i class="fa fa-file-powerpoint-o"></i>
                                                    @elseif($file->file_ext == 'xls' || $file->file_ext == 'xlsx')
                                                        <i class="fa fa-file-excel-o"></i>
                                                    @else
                                                        <i class="fa fa-file-o"></i>
                                                    @endif
                                                </div>
                                                <!-- <div class="file-size">{{ humanFileSize($file->file_size) }}</div> -->
                                            </div>
                                            <div class="info">
                                                <h4 class="title">{{ $file->name }}</h4>
                                                <!-- <p class="desc">{{ $file->desc }}</p> -->
                                                
                                            </div>
                                            <div class="action">
                                                <a class="newBtn btn-sm newBtn-primary loginBtn" style="width:103px; height:36px; line-height: 20px; font-size: 12px;" href="{{ route('download-file', [$file->file_name]) }}">Download</a>
                                                <!-- <div class="download-info">{{ $file->total_download }} download</div> -->
                                            </div>
                                        </div>
                                        <div class="date">
                                                    Diunggah pada:{{   date('d-m-Y', strtotime($file->created_at))  }}
                                            </div>
                                    </li>
                                @endforeach
                            </ul>
                            {{ $files->appends(request()->query())->links() }}
                            
                            @else
                                Data not found!
                            @endif
                            <!-- End of Download List -->
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('footScript')
    <script src="{{ asset('theme/front/vendor/scrolltofixed/jquery-scrolltofixed-min.js') }}"></script>

    <!-- js dropdown -->
    <script>
        /* When the user clicks on the button, 
        toggle between hiding and showing the dropdown content */
        function myFunction() {
        document.getElementById("myDropdown").classList.toggle("show");
        }

        // Close the dropdown if the user clicks outside of it
        window.onclick = function(event) {
        if (!event.target.matches('.dropbtn')) {
            var dropdowns = document.getElementsByClassName("dropdown-content");
            var i;
            for (i = 0; i < dropdowns.length; i++) {
            var openDropdown = dropdowns[i];
            if (openDropdown.classList.contains('show')) {
                openDropdown.classList.remove('show');
            }
            }
        }
        }
    </script>
    <!-- end js dropdown -->

    <script type="text/javascript">
        $(document).ready(function() {
            const offsetTop = 75;

            $('#faq-navigation').scrollToFixed({
                limit: function() {
                    return $('#contact').offset().top - $(this).outerHeight(true) - $('#contact').css('margin-top').replace('px', '');
                },
                marginTop: offsetTop,
                zIndex: 100,
                removeOffsets: true,

                preFixed: function() { $(this).css('width', '340px'); },
                preAbsolute: function() { $(this).css('width', '340px'); },
                postFixed: function() { $(this).css('width', '340px'); },
                postAbsolute: function() { $(this).css('width', '340px'); }
            });
        });
    </script>
@endsection