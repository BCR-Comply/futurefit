@extends('layouts.dashboard.app')

@section('content')

    <h4 class="page-title">User</h4>
    <div class="row">
        <div class="col-12">


                    <div class="row align-items-center gx-0">
                    <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="header-title">Input Types</h4>
                                        <p class="text-muted font-14">
                                            Most common form control, text-based input fields. Includes support for all HTML5 types: <code>text</code>, <code>password</code>, <code>datetime</code>, <code>datetime-local</code>, <code>date</code>, <code>month</code>, <code>time</code>, <code>week</code>, <code>number</code>, <code>email</code>, <code>url</code>, <code>search</code>, <code>tel</code>, and <code>color</code>.
                                        </p>

                                        <ul class="nav nav-tabs nav-bordered mb-3">
                                            <li class="nav-item">
                                                <a href="#input-types-preview" data-bs-toggle="tab" aria-expanded="false" class="nav-link active">
                                                    Preview
                                                </a>
                                            </li>
                                            <li class="nav-item">
                                                <a href="#input-types-code" data-bs-toggle="tab" aria-expanded="true" class="nav-link">
                                                    Code
                                                </a>
                                            </li>
                                        </ul> <!-- end nav-->

                                        <div class="tab-content">
                                            <div class="tab-pane show active" id="input-types-preview">
                                                <div class="row">
                                                    <div class="col-lg-6">
                                                        <form>
                                                            <div class="mb-3">
                                                                <label for="simpleinput" class="form-label">Text</label>
                                                                <input type="text" id="simpleinput" class="form-control">
                                                            </div>

                                                            <div class="mb-3">
                                                                <label for="example-email" class="form-label">Email</label>
                                                                <input type="email" id="example-email" name="example-email" class="form-control" placeholder="Email">
                                                            </div>

                                                            <div class="mb-3">
                                                                <label for="example-password" class="form-label">Password</label>
                                                                <input type="password" id="example-password" class="form-control" value="password">
                                                            </div>

                                                            <div class="mb-3">
                                                                <label for="password" class="form-label">Show/Hide Password</label>
                                                                <div class="input-group input-group-merge">
                                                                    <input type="password" id="password" class="form-control" placeholder="Enter your password">
                                                                    <div class="input-group-text" data-password="false">
                                                                        <span class="password-eye"></span>
                                                                    </div>
                                                                </div>
                                                            </div>

                                                            <div class="mb-3">
                                                                <label for="example-palaceholder" class="form-label">Placeholder</label>
                                                                <input type="text" id="example-palaceholder" class="form-control" placeholder="placeholder">
                                                            </div>

                                                            <div class="mb-3">
                                                                <label for="example-textarea" class="form-label">Text area</label>
                                                                <textarea class="form-control" id="example-textarea" rows="5"></textarea>
                                                            </div>

                                                            <div class="mb-3">
                                                                <label for="example-readonly" class="form-label">Readonly</label>
                                                                <input type="text" id="example-readonly" class="form-control" readonly="" value="Readonly value">
                                                            </div>

                                                            <div class="mb-3">
                                                                <label for="example-disable" class="form-label">Disabled</label>
                                                                <input type="text" class="form-control" id="example-disable" disabled="" value="Disabled value">
                                                            </div>

                                                            <div class="mb-3">
                                                                <label for="example-static" class="form-label">Static control</label>
                                                                <input type="text" readonly class="form-control-plaintext" id="example-static" value="email@example.com">
                                                            </div>

                                                            <div class="mb-0">
                                                                <label for="example-helping" class="form-label">Helping text</label>
                                                                <input type="text" id="example-helping" class="form-control" placeholder="Helping text">
                                                                <span class="help-block"><small>A block of help text that breaks onto a new line and may extend beyond one line.</small></span>
                                                            </div>

                                                        </form>
                                                    </div> <!-- end col -->

                                                    <div class="col-lg-6">
                                                        <form>

                                                            <div class="mb-3">
                                                                <label for="example-select" class="form-label">Input Select</label>
                                                                <select class="form-select" id="example-select">
                                                                    <option>1</option>
                                                                    <option>2</option>
                                                                    <option>3</option>
                                                                    <option>4</option>
                                                                    <option>5</option>
                                                                </select>
                                                            </div>

                                                            <div class="mb-3">
                                                                <label for="example-multiselect" class="form-label">Multiple Select</label>
                                                                <select id="example-multiselect" multiple class="form-control">
                                                                    <option>1</option>
                                                                    <option>2</option>
                                                                    <option>3</option>
                                                                    <option>4</option>
                                                                    <option>5</option>
                                                                </select>
                                                            </div>

                                                            <div class="mb-3">
                                                                <label for="example-fileinput" class="form-label">Default file input</label>
                                                                <input type="file" id="example-fileinput" class="form-control">
                                                            </div>

                                                            <div class="mb-3">
                                                                <label for="example-date" class="form-label">Date</label>
                                                                <input class="form-control" id="example-date" type="date" name="date">
                                                            </div>

                                                            <div class="mb-3">
                                                                <label for="example-month" class="form-label">Month</label>
                                                                <input class="form-control" id="example-month" type="month" name="month">
                                                            </div>

                                                            <div class="mb-3">
                                                                <label for="example-time" class="form-label">Time</label>
                                                                <input class="form-control" id="example-time" type="time" name="time">
                                                            </div>

                                                            <div class="mb-3">
                                                                <label for="example-week" class="form-label">Week</label>
                                                                <input class="form-control" id="example-week" type="week" name="week">
                                                            </div>

                                                            <div class="mb-3">
                                                                <label for="example-number" class="form-label">Number</label>
                                                                <input class="form-control" id="example-number" type="number" name="number">
                                                            </div>

                                                            <div class="mb-3">
                                                                <label for="example-color" class="form-label">Color</label>
                                                                <input class="form-control" id="example-color" type="color" name="color" value="#727cf5">
                                                            </div>

                                                            <div class="mb-0">
                                                                <label for="example-range" class="form-label">Range</label>
                                                                <input class="form-range" id="example-range" type="range" name="range" min="0" max="100">
                                                            </div>

                                                        </form>
                                                    </div> <!-- end col -->
                                                </div>
                                                <!-- end row-->
                                            </div> <!-- end preview-->

                                            <div class="tab-pane" id="input-types-code">
                                                <pre class="mb-0">
                                                    <span class="html escape">
                                                        &lt;div class=&quot;mb-3&quot;&gt;
                                                            &lt;label for=&quot;simpleinput&quot; class=&quot;form-label&quot;&gt;Text&lt;/label&gt;
                                                            &lt;input type=&quot;text&quot; id=&quot;simpleinput&quot; class=&quot;form-control&quot;&gt;
                                                        &lt;/div&gt;

                                                        &lt;div class=&quot;mb-3&quot;&gt;
                                                            &lt;label for=&quot;example-email&quot; class=&quot;form-label&quot;&gt;Email&lt;/label&gt;
                                                            &lt;input type=&quot;email&quot; id=&quot;example-email&quot; name=&quot;example-email&quot; class=&quot;form-control&quot; placeholder=&quot;Email&quot;&gt;
                                                        &lt;/div&gt;

                                                        &lt;div class=&quot;mb-3&quot;&gt;
                                                            &lt;label for=&quot;example-password&quot; class=&quot;form-label&quot;&gt;Password&lt;/label&gt;
                                                            &lt;input type=&quot;password&quot; id=&quot;example-password&quot; class=&quot;form-control&quot; value=&quot;password&quot;&gt;
                                                        &lt;/div&gt;

                                                        &lt;div class=&quot;mb-3&quot;&gt;
                                                            &lt;label for=&quot;password&quot; class=&quot;form-label&quot;&gt;Show/Hide Password&lt;/label&gt;
                                                            &lt;div class=&quot;input-group input-group-merge&quot;&gt;
                                                                &lt;input type=&quot;password&quot; id=&quot;password&quot; class=&quot;form-control&quot; placeholder=&quot;Enter your password&quot;&gt;
                                                                &lt;div class=&quot;input-group-text&quot; data-password=&quot;false&quot;&gt;
                                                                    &lt;span class=&quot;password-eye&quot;&gt;&lt;/span&gt;
                                                                &lt;/div&gt;
                                                            &lt;/div&gt;
                                                        &lt;/div&gt;

                                                        &lt;div class=&quot;mb-3&quot;&gt;
                                                            &lt;label for=&quot;example-palaceholder&quot; class=&quot;form-label&quot;&gt;Placeholder&lt;/label&gt;
                                                            &lt;input type=&quot;text&quot; id=&quot;example-palaceholder&quot; class=&quot;form-control&quot; placeholder=&quot;placeholder&quot;&gt;
                                                        &lt;/div&gt;

                                                        &lt;div class=&quot;mb-3&quot;&gt;
                                                            &lt;label for=&quot;example-textarea&quot; class=&quot;form-label&quot;&gt;Text area&lt;/label&gt;
                                                            &lt;textarea class=&quot;form-control&quot; id=&quot;example-textarea&quot; rows=&quot;5&quot;&gt;&lt;/textarea&gt;
                                                        &lt;/div&gt;

                                                        &lt;div class=&quot;mb-3&quot;&gt;
                                                            &lt;label for=&quot;example-readonly&quot; class=&quot;form-label&quot;&gt;Readonly&lt;/label&gt;
                                                            &lt;input type=&quot;text&quot; id=&quot;example-readonly&quot; class=&quot;form-control&quot; readonly=&quot;&quot; value=&quot;Readonly value&quot;&gt;
                                                        &lt;/div&gt;

                                                        &lt;div class=&quot;mb-3&quot;&gt;
                                                            &lt;label for=&quot;example-disable&quot; class=&quot;form-label&quot;&gt;Disabled&lt;/label&gt;
                                                            &lt;input type=&quot;text&quot; class=&quot;form-control&quot; id=&quot;example-disable&quot; disabled=&quot;&quot; value=&quot;Disabled value&quot;&gt;
                                                        &lt;/div&gt;

                                                        &lt;div class=&quot;mb-3&quot;&gt;
                                                            &lt;label for=&quot;example-static&quot; class=&quot;form-label&quot;&gt;Static control&lt;/label&gt;
                                                            &lt;input type=&quot;text&quot; readonly class=&quot;form-control-plaintext&quot; id=&quot;example-static&quot; value=&quot;email@example.com&quot;&gt;
                                                        &lt;/div&gt;

                                                        &lt;div class=&quot;mb-3&quot;&gt;
                                                            &lt;label for=&quot;example-helping&quot; class=&quot;form-label&quot;&gt;Helping text&lt;/label&gt;
                                                            &lt;input type=&quot;text&quot; id=&quot;example-helping&quot; class=&quot;form-control&quot; placeholder=&quot;Helping text&quot;&gt;
                                                            &lt;span class=&quot;help-block&quot;&gt;&lt;small&gt;A block of help text that breaks onto a new line and may extend beyond one line.&lt;/small&gt;&lt;/span&gt;
                                                        &lt;/div&gt;

                                                        &lt;div class=&quot;mb-3&quot;&gt;
                                                            &lt;label for=&quot;example-select&quot; class=&quot;form-label&quot;&gt;Input Select&lt;/label&gt;
                                                            &lt;select class=&quot;form-select&quot; id=&quot;example-select&quot;&gt;
                                                                &lt;option&gt;1&lt;/option&gt;
                                                                &lt;option&gt;2&lt;/option&gt;
                                                                &lt;option&gt;3&lt;/option&gt;
                                                                &lt;option&gt;4&lt;/option&gt;
                                                                &lt;option&gt;5&lt;/option&gt;
                                                            &lt;/select&gt;
                                                        &lt;/div&gt;

                                                        &lt;div class=&quot;mb-3&quot;&gt;
                                                            &lt;label for=&quot;example-multiselect&quot; class=&quot;form-label&quot;&gt;Multiple Select&lt;/label&gt;
                                                            &lt;select id=&quot;example-multiselect&quot; multiple class=&quot;form-control&quot;&gt;
                                                                &lt;option&gt;1&lt;/option&gt;
                                                                &lt;option&gt;2&lt;/option&gt;
                                                                &lt;option&gt;3&lt;/option&gt;
                                                                &lt;option&gt;4&lt;/option&gt;
                                                                &lt;option&gt;5&lt;/option&gt;
                                                            &lt;/select&gt;
                                                        &lt;/div&gt;

                                                        &lt;div class=&quot;mb-3&quot;&gt;
                                                            &lt;label for=&quot;example-fileinput&quot; class=&quot;form-label&quot;&gt;Default file input&lt;/label&gt;
                                                            &lt;input type=&quot;file&quot; id=&quot;example-fileinput&quot; class=&quot;form-control&quot;&gt;
                                                        &lt;/div&gt;

                                                        &lt;div class=&quot;mb-3&quot;&gt;
                                                            &lt;label for=&quot;example-date&quot; class=&quot;form-label&quot;&gt;Date&lt;/label&gt;
                                                            &lt;input class=&quot;form-control&quot; id=&quot;example-date&quot; type=&quot;date&quot; name=&quot;date&quot;&gt;
                                                        &lt;/div&gt;

                                                        &lt;div class=&quot;mb-3&quot;&gt;
                                                            &lt;label for=&quot;example-month&quot; class=&quot;form-label&quot;&gt;Month&lt;/label&gt;
                                                            &lt;input class=&quot;form-control&quot; id=&quot;example-month&quot; type=&quot;month&quot; name=&quot;month&quot;&gt;
                                                        &lt;/div&gt;

                                                        &lt;div class=&quot;mb-3&quot;&gt;
                                                            &lt;label for=&quot;example-time&quot; class=&quot;form-label&quot;&gt;Time&lt;/label&gt;
                                                            &lt;input class=&quot;form-control&quot; id=&quot;example-time&quot; type=&quot;time&quot; name=&quot;time&quot;&gt;
                                                        &lt;/div&gt;

                                                        &lt;div class=&quot;mb-3&quot;&gt;
                                                            &lt;label for=&quot;example-week&quot; class=&quot;form-label&quot;&gt;Week&lt;/label&gt;
                                                            &lt;input class=&quot;form-control&quot; id=&quot;example-week&quot; type=&quot;week&quot; name=&quot;week&quot;&gt;
                                                        &lt;/div&gt;

                                                        &lt;div class=&quot;mb-3&quot;&gt;
                                                            &lt;label for=&quot;example-number&quot; class=&quot;form-label&quot;&gt;Number&lt;/label&gt;
                                                            &lt;input class=&quot;form-control&quot; id=&quot;example-number&quot; type=&quot;number&quot; name=&quot;number&quot;&gt;
                                                        &lt;/div&gt;

                                                        &lt;div class=&quot;mb-3&quot;&gt;
                                                            &lt;label for=&quot;example-color&quot; class=&quot;form-label&quot;&gt;Color&lt;/label&gt;
                                                            &lt;input class=&quot;form-control&quot; id=&quot;example-color&quot; type=&quot;color&quot; name=&quot;color&quot; value=&quot;#727cf5&quot;&gt;
                                                        &lt;/div&gt;

                                                        &lt;div class=&quot;mb-0&quot;&gt;
                                                            &lt;label for=&quot;example-range&quot; class=&quot;form-label&quot;&gt;Range&lt;/label&gt;
                                                            &lt;input class=&quot;form-range&quot; id=&quot;example-range&quot; type=&quot;range&quot; name=&quot;range&quot; min=&quot;0&quot; max=&quot;100&quot;&gt;
                                                        &lt;/div&gt;
                                                    </span>
                                                </pre> <!-- end highlight-->
                                            </div> <!-- end preview code-->
                                        </div> <!-- end tab-content-->
                                    </div> <!-- end card-body -->
                                </div> <!-- end card -->
                            </div><!-- end col -->
                        </div><!-- end row -->

<!--
                        <div class="col-auto">

                            <span class="h2 fe fe-dollar-sign text-muted mb-0"></span>

                        </div> -->

            </div>

        </div>
    </div>


@endsection
